<?php
	//ispis fajlova i opcija sa fajlovima
	include('../include/db_conn.php');
	$result = mysqli_query($conn,"select * from materijali,korisnik where materijali.sifra_predmeta='".$_POST['odabir_pred']."' and materijali.tip_materijala='".$_POST['odabir_sekc']."' and materijali.id_nastavnika=korisnik.email order by materijali.redosled");
	echo "<table>";
	echo "<th>Ime</th>";
	echo "<th>Tip</th>";
	echo "<th>Datum</th>";
	echo "<th>Veličina</th>";
	echo "<th>Dodao</th>";
	echo "<th>Vidljivo</th>";
	$num = mysqli_num_rows($result);
	for($i = 0;$i<$num;$i++){
		$row=mysqli_fetch_assoc($result);
		echo "<tr><td>".$row['naslov']."</td>";
		$tmp = explode('.',$row['putanja']);
		echo "<td>".end($tmp)."</td>";
		$tmp = explode('-',$row['datum']);
		echo "<td>".$tmp[2].".".$tmp[1].".".$tmp[0].".</td>";
		echo "<td>&nbsp;".number_format(filesize($row['putanja'])/1024,2)." KB </td>";
		echo "<td>".$row['name']." ".$row['surname']."</td>";
		echo "<td><input type='checkbox'".($row['vidljiv']?"checked":"")." name='".$row['id_materijal']."' onchange='return vidi(this);'></td>";
		if($i==0)
			echo "<td></td>";
		else
			echo "<td><button onclick='return gore(".$row['redosled'].",".$row['id_materijal'].")'>Gore</button></td>";
		if($i==($num-1))
			echo "<td></td>";
		else
			echo "<td><button onclick='return dole(".$row['redosled'].",".$row['id_materijal'].")'>Dole</button></td>";
		echo "<td><button onclick='return obr(".$row['id_materijal'].")'>Obrisi</button></td></tr>";
		
	}
	echo "</table>";
	echo "<input id='fajlovi' type='file' name='fajlovi[]' multiple='multiple' OnChange='fja()' />";
	echo "<div id='imena'></div>";

	include('../include/db_disconn.php');
?>