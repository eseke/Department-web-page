<?php
    if(isset($_POST['logout'])){
        unset($_SESSION['name']);
        header("Location: #");
    }elseif(isset($_POST['login'])){
        include('db_conn.php');
        $result = mysqli_query($conn, "select * from korisnik where email='".$_POST['username']."' and pass='".$_POST['pass']."'");
        if(mysqli_num_rows($result)){
            $_SESSION['name'] = mysqli_fetch_assoc($result)['name'];
        }
        else{
            $_SESSION['poruka'] = "Nisu dobri podaci";
        }
        include('db_disconn.php');
        header("Location: #");
    }
    ?>