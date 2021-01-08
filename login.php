<?php
    
    if(isset($_POST['logout'])){
        unset($_SESSION['name']);
        header("Location: #");
    }elseif(isset($_POST['login'])){
        include('db_conn.php');
        $result = mysqli_query($conn, "select * from korisnik where email='".$_POST['username']."' and pass='".$_POST['pass']."'");
        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            if($row['type']=="a")
                $_SESSION['role'] = 'Administrator';
            elseif($row['type']=="s")
                $_SESSION['role'] = 'Student';
        }
        else{
            $_SESSION['login_mess'] = "Nisu dobri podaci";
        }
        include('db_disconn.php');
        header("Location: #");
    }
    ?>