<?php
	//ispisivanje informacija o predmentu
	$res = mysqli_query($conn,"select * from predmet where sifra_predmeta='".$_GET['sifra']."'");
	$row = mysqli_fetch_assoc($res);
	echo "Broj ESPB: ".$row['broj_ESPB']."</br>";
	echo "Šifra predmeta: ".$row['sifra_predmeta']."</br>";
	$tmp = explode('+',$row['fond_casova']);
	echo "Broj časova predavanja: ".$tmp[0]."</br>";
	echo "Broj časova vežbi: ".$tmp[1]."</br>";
	echo "Broj časova praktične nastave: ".$tmp[2]."</br>";
	echo "Cilj predmeta: ".$row['cilj_predmeta']."</br>";
	echo "Ishod predmeta: ".$row['ishod_predmeta']."</br>";
	$res1 = mysqli_query($conn,"select * from nastavni_plan,odsek where sifra_predmeta='".$_GET['sifra']."' and nastavni_plan.id_odseka=odsek.id");
	echo "Ovaj predmet se drži na sledećim odsecima:</br>";
	while($row1 = mysqli_fetch_assoc($res1)){
		if($row1['Tip_predmeta']=='o')
			echo "&nbsp;&nbsp;Obavezan ";
		else	
			echo "&nbsp;&nbsp;Izborni ";
		echo $row1['semestar']." semestar ".$row1['naziv_odseka']."</br>";
	}
	echo "Raspored nastave:";
	//dinamicko ispisivanje informacija o grupama na predmetu, terminima nastave i nastavnicima
	$res1 = mysqli_query($conn,"select korisnik.status,zaposleni.id,grupa.oznaka,grupa.dan,grupa.vreme,korisnik.name,korisnik.surname from drzi_predmet,grupa,korisnik,zaposleni where grupa.sifra_predmeta='".$_GET['sifra']."' and grupa.id=drzi_predmet.id_grupe and drzi_predmet.id_nastavnika=korisnik.email and zaposleni.email=drzi_predmet.id_nastavnika order by grupa.oznaka asc");
	while($row1 = mysqli_fetch_assoc($res1)){
		if($row1['status'])
			echo "<br/>&nbsp &nbsp".$row1['oznaka']." ".$row1['dan']." ".$row1['vreme']." <a href='zaposleni?id=".$row1['id']."'>".$row1['name']." ".$row1['surname']."</a>";
	}
?>