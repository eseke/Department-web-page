<?php

include('./include/db_conn.php');
//trazenje zaposlenog
$result = mysqli_query($conn,'SELECT * from `zaposleni`,`korisnik` where `zaposleni`.`email`=`korisnik`.`email` and `zaposleni`.`id`='.$_GET['id']);
if(!mysqli_num_rows($result))
    header("Location: zaposleni");
$row = mysqli_fetch_assoc($result);
if(!$row['status'])//ukoliko zaposleni nema aktivan status on se ne prikazuje
    header("Location: zaposleni");
echo "<table>";
echo "<tr><td>";
if($row['profilna_slika']=="")//ukoliko nema slike prikazuje se neka default slika
    echo "<img width='150px' src='https://upload.wikimedia.org/wikipedia/commons/1/1e/Default-avatar.jpg' >";
else//prikaz slike zaposlenog
    echo "<img width='150px' src=".$row["profilna_slika"]." >";
echo "</td><td>";
echo "<title>".$row['name']." ".$row['surname']."</title>";//ispis informacija o zaposlenom
echo "Ime: ".$row['name']."<br/>";
echo "Prezime: ".$row['surname']."<br/>";
echo "Email: ".$row['email']."<br/>";
echo "Zvanje: ".$row['zvanje']."<br/>";
echo "Kabinet: ".$row['broj_kabineta']."<br/>";
if($row['biografija']!="")
    echo "Biografija: ".$row['biografija']."<br/>";
if($row['licni_sajt'])
    echo "Lični sajt: <a href='".$row['licni_sajt']."'>".$row['licni_sajt']."</a>";
echo "</td></tr>";
echo "</table>";
include('./include/db_disconn.php');

?>