<?php
echo "<h3>".$row['naslov']."</h3>";
$tmp = explode('-',$row['datum_objave']);
echo "<i>".$row['name']." ".$row['surname']." ".$tmp[2].".".$tmp[1].".".$tmp[0].".</i></br>";
echo $row['sadrzaj']."</br>";

?>