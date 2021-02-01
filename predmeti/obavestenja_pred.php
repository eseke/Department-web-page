<?php
function ispis_obav($sifra,$izm){
	include($_SERVER['DOCUMENT_ROOT']."/include/db_conn.php");
	$result = mysqli_query($conn,"select * from obavestenje_predmet,korisnik where obavestenje_predmet.id_predmeta='".$sifra."' and korisnik.email=obavestenje_predmet.id_nastavnika");
	while($row = mysqli_fetch_assoc($result)){
		if(((time()-strtotime($row['datum_objave']))/(60*60*24))>7)
			echo "<div id='davno'>";
		else
			echo "<div>";
		echo "<h3>".$row['naslov']."</h3>";
		$tmp = explode('-',$row['datum_objave']);
		echo "<i>".$row['name']." ".$row['surname']." ".$tmp[2].".".$tmp[1].".".$tmp[0].".</i>".($izm?" <a href='izmeni_obavestenje?id=".$row['id_obavestenja']."'>Izmeni</a>":"")."</br>";
		echo $row['sadrzaj']."</br>";
		$res1 = mysqli_query($conn,"select * from fajl_uz_obavestenje where fajl_uz_obavestenje.id_obavestenja='".$row['id_obavestenja']."' order by ime_fajla asc");
		while($row=mysqli_fetch_assoc($res1))
			echo"<a href='".$row['putanja']."'>".$row['ime_fajla']."</a><br/>";
		echo "</div>";
	}
	include($_SERVER['DOCUMENT_ROOT']."/include/db_disconn.php");
}
?>