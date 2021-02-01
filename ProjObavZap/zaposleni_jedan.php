<?php

include('./include/db_conn.php');

$result = mysqli_query($conn,'SELECT * from `zaposleni`,`korisnik` where `zaposleni`.`email`=`korisnik`.`email` and `zaposleni`.`id`='.$_GET['id']);
if(!mysqli_num_rows($result))
    header("Location: zaposleni");
$row = mysqli_fetch_assoc($result);
if(!$row['status'])
    header("Location: zaposleni");
echo "<title>".$row['name']." ".$row['surname']."</title>";
echo "Ime: ".$row['name']."<br/>";
echo "Prezime: ".$row['surname']."<br/>";
echo "Email: ".$row['email']."<br/>";
echo "Zvanje: ".$row['zvanje']."<br/>";
echo "Kabinet: ".$row['broj_kabineta']."<br/>";
echo "Biografija: ".$row['biografija']."<br/>";
echo "<img width='150px' src=".$row["profilna slika"]." >";

include('./include/db_disconn.php');

?>