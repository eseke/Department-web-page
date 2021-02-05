<?php
    /*
    Ovaj deo koda se koristi u svakoj stranici.
    On sluzi za login/logout aktivnosti.
    */
    if(isset($_POST['logout'])){//poziva se pri logout-u
        include_once('logout.php');
        header("Location: #");
    }
    else if(isset($_SESSION['first'])&& !isset($passpage)){
        header('Location:/password');
        //ukolko neko pri prvom logovanju proba da pristupi nekoj stranici koja nije za promenu šifre 
        //on se outomatski prosleđi na stranicu za promenu šifre

    }elseif(isset($_POST['login'])){//ukoliko neko pokusava da se uloguje
        include('db_conn.php');
        $result = mysqli_query($conn, "select * from korisnik where email='".$_POST['username']."' and pass='".$_POST['pass']."'");
        if(mysqli_num_rows($result)){//proverava se da li su email i sifra u bazi, ako je su onda se u sessiju upisuju potrebni podaci
            $row = mysqli_fetch_assoc($result);
            if($row['status']){
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['type'] = $row['type'];
                if($row['first_access']){
                    $_SESSION['first'] = true;
                }
                if($row['type']=="a")
                    $_SESSION['role'] = 'Administrator';
                elseif($row['type']=="s"){//proverava se tip studija za studenta
                    $result = mysqli_query($conn, "select * from student where email='".$_POST['username']."'");
                    $row = mysqli_fetch_assoc($result);
                    if($row['tip_studija']=='d')
                        $_SESSION['role'] = 'Student osnovnih studija';
                    else if($row['tip_studija']=='m')
                    $_SESSION['role'] = 'Student master studija';
                    else if($row['tip_studija']=='p')
                        $_SESSION['role'] = 'Student doktorskih studija';
                }
                else{//za zaposlenog se traži zvanje
                    $result = mysqli_query($conn, "select `zaposleni`.`zvanje` from zaposleni where email='".$_POST['username']."'");
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['role'] = $row['zvanje'];
                }                    
            }else
                $_SESSION['login_mess'] = "Obratite se administratoru za aktivaciju naloga!";
        }
        else{//ukoliko nisu dobri podaci ispisuje se odgovarajuca poruka
            $_SESSION['login_mess'] = "Nisu dobri podaci";
        }
        include('db_disconn.php');
        
        if($_SESSION['first']){
            header('Location:/password');
        }
        else{
        header("Location: #");
        }
    }
    ?>