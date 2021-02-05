<?php
//ispis projeta u različitim delovima sajta
echo "<h3>".$row['naslov']."</h3>";
if(!isset($_GET['tip']))
    echo $row['kategorija']."<br/>";
$tmp = explode('-',$row['rok_prijava']);
echo "<i>Pukovodilac: ".$row['name']." ".$row['surname']."<br/>Rok za prijavu: ".$tmp[2].".".$tmp[1].".".$tmp[0].".</i></br>";
echo $row['sadrzaj']."</br>";

?>