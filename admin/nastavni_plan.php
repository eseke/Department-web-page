<?php
if(isset($_POST['nastavnik'])){//ajax dodavanje nastavnika na grupu
	include_once('../include/db_conn.php');
	echo mysqli_query($conn,"insert into drzi_predmet(id_nastavnika,id_grupe) values('".$_POST['nastavnik']."',".$_POST['grupa'].")");
}
else if(isset($_POST['predmet2'])){//ajax ucitavanje grupa na predmetu
	include_once('../include/db_conn.php');
	$result = mysqli_query($conn,"select * from grupa where sifra_predmeta='".$_POST['predmet2']."'");
	echo "Izaberite grupu: <select id='grupa'>";
	echo "<option value=''></option>";
	while($row=mysqli_fetch_assoc($result))
		echo "<option value='".$row['id']."'>".$row['oznaka']."</option>";
	echo "</select><br/>";
	echo "<input type='submit' value='Dodaj' onclick='return dodaj_nas();'>";
}
else if(isset($_POST['tip'])){//dodavanje nove grupe na predmet
	include_once('../include/db_conn.php');
	$result = mysqli_query($conn,"select * from grupa where sifra_predmeta='".$_POST['pred']."' and oznaka like '".($_POST['tip']=='predavanja'?'P':'V')."%'");
	$res = mysqli_num_rows($result);
	echo mysqli_query($conn,"insert into grupa(sifra_predmeta,oznaka,dan,vreme) values ('".$_POST['pred']."','".($_POST['tip']=='predavanja'?'P':'V').($res+1)."','".$_POST['dan']."','".$_POST['vreme'].":00')");
}
else{//ucitavanje stranice
?>
<head>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
	<script src='../script/ajax.js'></script>
    <title>Nastavni plan</title>
</head>

<body>
    <div class='container'>

<?php
	session_start();
	header('Content-type: text/html; charset=utf-8');
	if(!isset($_SESSION['email'])|| !($_SESSION['type'] == 'a'))
		header('Location: ../');
	
	include('../include/db_conn.php');
	include('header_admin.php');
	include('menu_admin.html');
	include('../include/login.php');

	echo "<h4>Dodavanje grupe predmetu</h4>";//ovde pocinje doavanje grupe na predmet
	$result = mysqli_query($conn,"select * from predmet");
	echo "Izaberite predmet:<select id='predmet1'>";
	echo "<option value=''></option>";
	while($row=mysqli_fetch_assoc($result))
		echo "<option value='".$row['sifra_predmeta']."'>".$row['naziv']."</option>";
	echo "<select/><br/>";
	?>
	Predavanja/vezbe: <select id='tip'>
	<option value=''></option>
		<option value='predavanja'>Predavanja</option>
		<option value='vezbe'>Vežbe</option>
	</select><br/>
	Dan u nedelji: <select id='dan'>
		<option value=''></option>
		<option value='ponedeljak'>ponedeljak</option>
		<option value='utorak'>utorak</option>
		<option value='sreda'>sreda</option>
		<option value='četvrtak'>četvrtak</option>
		<option value='petak'>petak</option>
	</select><br/>
	Vreme početka: <input type="number" id='vreme' min="8" max='20' step="1" oninput="validity.valid||(value='');"><br/>
	<input type='submit' value='Dodaj' onclick='return dodaj_gr();'>
	<div id='obv1'></div>
	<?php
	echo "<h4>Dodavanje grupe nastavniku</h4>";//ovde pocinje dodavanje nastavnika na grupu
	$result = mysqli_query($conn,"select * from zaposleni,korisnik where zaposleni.email=korisnik.email");
	echo "Izaberite nastavnika:<select id='nastavnik1'>";
	echo "<option value=''></option>";
	while($row=mysqli_fetch_assoc($result))
		echo "<option value='".$row['email']."'>".$row['name']." ".$row['surname']."</option>";
	echo "<select/><br/>";

	$result = mysqli_query($conn,"select distinct grupa.sifra_predmeta,predmet.naziv from grupa,predmet where grupa.sifra_predmeta=predmet.sifra_predmeta");
	echo "Izaberite predmet:<select id='predmet2' onchange='return ispis_gr();'>";
	echo "<option value=''></option>";
	while($row=mysqli_fetch_assoc($result))
		echo "<option value='".$row['sifra_predmeta']."'>".$row['naziv']."</option>";
	echo "<select/><br/>";
	echo "<div id='grupe'></div>";
	echo "<div id='obv2'></div>";

	include('../include/footer.html');
	include('../include/db_disconn.php');
?>

	</div>
</doby>
<?php
}
?>