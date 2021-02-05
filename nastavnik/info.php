<?php
	//informacije o predmetima i mogućnosti za njihovu izmenu
	include('../include/db_conn.php');
	$result = mysqli_query($conn,"select * from predmet where sifra_predmeta='".$_POST['odabir_pred']."'");
	$row = mysqli_fetch_assoc($result);
	echo "<table>";
	echo "<tr><td>ESPB:</td><td> <input type='text' name='ESPB' value='".$row['broj_ESPB']."' id='ESPB'></td></tr>";
	echo "<tr><td>Naziv predmeta:</td><td> <input type='text' name='naziv' value='".$row['naziv']."' id='naziv'></td></tr>";
	$tmp = explode('+',$row['fond_casova']);
	echo "<tr><td>Broj časova predavanja:</td><td> <input type='text' value='".$tmp[0]."' name='br_pred' id='br_pred'></td></tr>";
	echo "<tr><td>Broj časova vežbi:</td><td> <input type='text' value='".$tmp[1]."' name='br_vez' id='br_vez'></td></tr>";
	echo "<tr><td>Broj časova laboratorijskih vežbi:</td><td> <input type='text' value='".$tmp[2]."' name='br_lab' id='br_lab'></td></tr>";
	echo "</table>";
	echo "Cilj predmeta:<br/>";
	echo "<textarea name='sadrzaj' id='editor1'>".$row['cilj_predmeta']."</textarea>";
	echo "Ishod predmeta:<br/>";
	echo "<textarea name='ishod' id='editor2'>".$row['ishod_predmeta']."</textarea>";
	echo "Komentar:<br/>";
	echo "<textarea name='kom' id='editor3'>".$row['komentar']."</textarea>";
	$result = mysqli_query($conn,"select * from nastavni_plan,odsek where nastavni_plan.sifra_predmeta='".$_POST['odabir_pred']."' and nastavni_plan.id_odseka=odsek.id");
	if(mysqli_num_rows($result)){//izbor semestra i pita predmeta po odsecima
		echo "Odaberite tip predmet i semestar za sledeće odseke:";
		echo "<table>";
		while($row=mysqli_fetch_assoc($result)){
			echo "<tr><td>".$row['naziv_odseka']."</td>";
			
			echo "<td><select name='iz/ob".$row['id_odseka']."' id='iz/ob".$row['id_odseka']."'>";
			echo "<option value='o' ".($row['Tip_predmeta']=='o'?'selected':'').">Obavezan</option>";
			echo "<option value='i' ".($row['Tip_predmeta']=='i'?'selected':'').">Izborni</option>";
			echo "</select></td>";

			echo "<td><select name='s".$row['id_odseka']."' id='semestar".$row['id_odseka']."'>";
			for($i=1;$i<11;$i++)
				echo "<option value='".$i."'".($row['semestar']==$i?'selected':'').">".$i."</option>";
			echo "</select></td></tr>";
		}
	}
	echo "</table>";
	echo "<input type='Submit' name='izmeni' value='izmeni' onclick='return proveri_formu1()' id='izmeni'>";
	echo "<div id='info'></div>";
	include('../include/db_disconn.php');
?>