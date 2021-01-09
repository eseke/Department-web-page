<?php
    echo "<title>Zaposleni</title>";
    include('db_conn.php');
    $result = mysqli_query($conn,'SELECT DISTINCT `korisnik`.`status`,`predmet`.`aktivan`,`korisnik`.`name`,`korisnik`.`surname`,`zaposleni`.`email`,`predmet`.`naziv`,`predmet`.`sifra_predmeta`'.
    ',`zaposleni`.`zvanje`,`zaposleni`.`id` FROM `zaposleni`,`drzi_predmet`,`predmet`,`korisnik` WHERE `zaposleni`.`email`=`drzi_predmet`.`id_nastavnika` and '.
    '`drzi_predmet`.`sifra_predmeta`=`predmet`.`sifra_predmeta` and `zaposleni`.`email`=`korisnik`.`email` order by `zaposleni`.`email` asc');

    $arr = [];
    if(mysqli_num_rows($result)){
        $last = '';
        while($row = mysqli_fetch_assoc($result)){
            if(!$row['status'] || !$row['aktivan'])
                continue;
            if($last!=$row['email']){
                echo "<a href='zaposleni?id=".$row['id']."'>".$row['name'].' '.$row['surname'].'</a> '.$row['zvanje'].'<br/>';
                $arr[$row['email']]=true;
            };
            $last = $row['email'];
            echo '&nbsp &nbsp'.$row['sifra_predmeta'].' '.$row['naziv'].'<br/>';
        }
    }
    $result = mysqli_query($conn,'SELECT `korisnik`.`status`,`korisnik`.email,`korisnik`.`name`,`korisnik`.`surname`,`zaposleni`.`zvanje`,`zaposleni`.`id` FROM `korisnik`,`zaposleni` WHERE `korisnik`.`email`=`zaposleni`.`email`');
    if(mysqli_num_rows($result)){
        while($row = mysqli_fetch_assoc($result)){
            if(!$row['status'])
                continue;
            if(!isset($arr[$row['email']])){
                echo "<a href='zaposleni?id=".$row['id']."'>".$row['name'].' '.$row['surname'].'</a> '.$row['zvanje'].'<br/>';
            };
        }
    }
    include('db_disconn.php');
    ?>