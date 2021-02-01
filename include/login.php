<?php
    
    if(isset($_POST['logout'])){
        unset($_SESSION['name']);
        unset($_SESSION['surname']);
        unset($_SESSION['role']);
        unset($_SESSION['email']);
        if(isset($_SESSION['tip_studija']));
           unset($_SESSION['tip_studija']);
        header("Location: #");
    }elseif(isset($_POST['login'])){
        include('db_conn.php');
        $result = mysqli_query($conn, "select * from korisnik where email='".$_POST['username']."' and pass='".$_POST['pass']."'");
        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['type'] = $row['type'];
            if($row['type']=="a")
                $_SESSION['role'] = 'Administrator';
            elseif($row['type']=="s"){
                $result = mysqli_query($conn, "select * from student where email='".$_POST['username']."'");
                $row = mysqli_fetch_assoc($result);
                if($row['tip_studija']=='d')
                    $_SESSION['role'] = 'Student osnovnih studija';
                else if($row['tip_studija']=='m')
                $_SESSION['role'] = 'Student master studija';
                else if($row['tip_studija']=='p')
                    $_SESSION['role'] = 'Student doktorskih studija';
            }
            else{
                $result = mysqli_query($conn, "select `zaposleni`.`zvanje` from zaposleni where email='".$_POST['username']."'");
                $row = mysqli_fetch_assoc($result);
                $_SESSION['role'] = $row['zvanje'];
            }
        }
        else{
            $_SESSION['login_mess'] = "Nisu dobri podaci";
        }
        include('db_disconn.php');
        header("Location: #");
    }
    ?>