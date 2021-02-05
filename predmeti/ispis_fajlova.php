<?php
	//ispis razlicitih kategorija fajlova uz predmet
	$res = mysqli_query($conn,"select * from materijali where materijali.sifra_predmeta='".$_GET['sifra']."' and materijali.tip_materijala='".$_GET['str']."' order by materijali.redosled asc");
	while($row = mysqli_fetch_assoc($res)){
		if($row['vidljiv'])
			echo "<a href='".$row['putanja']."'>".$row['naslov']."<a/><br/>";
	}
?>