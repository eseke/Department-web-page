<?php
#var_dump($_POST);
include_once("../include/db_conn.php");
if(isset($_POST['obrisi'])){
	mysqli_query($conn,"delete from korisnik where email='".$_POST['id']."'");
	mysqli_query($conn,"delete from zaposleni where email='".$_POST['id']."'");
	header('Location:#');
}
else if(isset($_POST['id']) && isset($_POST['name'])){
	$email = $_POST['username']."@etf.bg.ac.rs";
	$res1 = mysqli_query($conn,"update korisnik set email='".$email."',".($_POST['pass']!=''?"pass='".$_POST['pass']."',":"")."name='".$_POST['name']."',surname='".$_POST['surname']."',status='".(isset($_POST['status'])?"1":"0")."',type='z' where email='".$_POST['id']."'");
	$res2 = mysqli_query($conn,"update zaposleni set email='".$email."',adresa = '".$_POST['adresa']."',mobilni = '".$_POST['mobilni']."',licni_sajt='".$_POST['sajt']."',biografija='".$_POST['biografija']."',zvanje='".$_POST['zvanje']."',broj_kabineta='".$_POST['kabinet']."',profilna_slika ='".$_POST['slika']."' where email='".$_POST['id']."'");
	if($res1 && $res2)
		echo "1";
}
else if(isset($_POST['name'])){
	$res1 = mysqli_query($conn,"insert into korisnik (email,pass,name,surname,status,first_access,type) values ('".$_POST['username']."@etf.bg.ac.rs','".$_POST['pass']."','".$_POST['name']."','".$_POST['surname']."','".(isset($_POST['status'])?"1":"0")."',1,'z')");
	$res2 = mysqli_query($conn,"insert into zaposleni(email,adresa,mobilni,licni_sajt,biografija,zvanje,broj_kabineta,profilna_slika) values('".$_POST['username']."@etf.bg.ac.rs','".$_POST['adresa']."','".$_POST['mobilni']."','".$_POST['sajt']."','".$_POST['biografija']."','".$_POST['zvanje']."','".$_POST['kabinet']."','".$_POST['slika']."')");
	if($res1 && $res2)
		echo "1";
}
else if(isset($_POST['id'])){
	$result = mysqli_query($conn,"select * from zaposleni, korisnik where zaposleni.email=korisnik.email and zaposleni.email='".$_POST['id']."'");
	$row = mysqli_fetch_assoc($result);
	echo "<table>";
	$tmp = explode('@',$row['email']);
	echo "<tr><td>Korisničko ime:</td><td><input type='text' name='username' id='username'value='".$tmp[0]."'>@etf.bg.ac.rs</tr>";
	echo "<tr><td>Šifra:</td><td><input type='password' name='pass' id='pass'></tr>";
	echo "<tr><td>Ime:</td><td><input type='text' name='name' value='".$row['name']."'></tr>";
	echo "<tr><td>Prezime:</td><td><input type='text' name='surname' value='".$row['surname']."'><br/>";
	echo "<tr><td>Adresa:</td><td><input type='text' name='adresa' value='".$row['adresa']."'></tr>";
	echo "<tr><td>Mobilni telefon:</td><td><input type='number' name='mobilni' value='".$row['mobilni']."'></tr>";
	echo "<tr><td>Web sajt:</td><td><input type='text' name='sajt' value='".$row['licni_sajt']."'></tr>";
	echo "
	<tr><td>Zvanje:</td><td><select name='zvanje'>
	<option value=''></option>
	<option value='redovni profesor' ".($row['zvanje']=='redovni profesor'?"selected":"").">Redovni profesor</option>
	<option value='vanredni profesor' ".($row['zvanje']=='vanredni profesor'?"selected":"").">Vanredni profesor</option>
	<option value='docent' ".($row['zvanje']=='docent'?"selected":"").">Docent</option>
	<option value='asistent' ".($row['zvanje']=='asistent'?"selected":"").">Asistent</option>
	<option value='saradnik u nastavi' ".($row['zvanje']=='saradnik u nastavi'?"selected":"").">Saradnik u nastavi</option>
	<option value='istraživač' ".($row['zvanje']=='istraživač'?"selected":"").">Istraživač</option>
	<option value='laboratorijski inženjer' ".($row['zvanje']=='laboratorijski inženjer'?"selected":"").">Laboratorijski inženjer</option>
	<option value='laboratorijski tehničar' ".($row['zvanje']=='laboratorijski tehničar'?"selected":"").">Laboratorijski tehničar</option>
	</select>
	";
	echo "<tr><td>Broj kabineta:</td><td><input type='text' name='kabinet' value='".$row['broj_kabineta']."'></tr>";
	echo "<tr><td>Status:</td><td><input type='checkbox' name='status' ".($row['status']?"checked":"")."></tr>";
	echo "<tr><td>Link ka slici:</td><td><input type='text' name='slika' value='".$row['profilna_slika']."'></tr>";
	echo "<tr><td>Biografija:</td><td><textarea name='biografija'>".$row['biografija']."</textarea></td></tr>";
	echo "</table>";
	echo "<input type='submit' value='Ažuriraj' name='dodaj' onclick='return azur_nast();'>";
	echo "<input type='submit' name='obrisi' value='Obriši nastavnika'><br/>";

}else{
?>
	<head>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
	<script src="../script/ajax.js"></script>
	<script src="../script/script.js"></script>
    <title>Zaposleni</title>
</head>

<body>
    <div class='container'>

<?php
	session_start();
	header('Content-type: text/html; charset=utf-8');
	if(!isset($_SESSION['email'])|| !($_SESSION['type'] == 'a'))
		header('Location: ../');
	include('header_admin.php');
	include('menu_admin.html');
	include('../include/login.php');
	if(!isset($_GET['tip']) || !($_GET['tip']=='nov'||$_GET['tip']=='azuriraj'))
		header('Location:korisnici');
	?>
	<form id='forma' action='' method='post'>
	
	<?php 
		if($_GET['tip']=='azuriraj'){
	?>
	<h5>Ažuriranje zaposlenog</h5>
	Odaberi zaposlenog: <select id='id' name='id' onchange="ispis_zap()">
	<option value=''></option>
	<?php

	$result = mysqli_query($conn,"select * from zaposleni, korisnik where zaposleni.email=korisnik.email");
	while($row=mysqli_fetch_assoc($result))
		echo "<option id='".$row['email']."' value='".$row['email']."'>".$row['name']." ".$row['surname']."</option>";
	echo "</select>";
	echo "<div id='sadrzaj'></div>";
	}else{		
	?>
	
	<h5>Dodavanje novog zaposlenog</h5>
	<table>
	<tr><td>Korisničko ime:</td><td><input type='text' name='username' id='username'>@etf.bg.ac.rs</tr>
	<tr><td>Šifra:</td><td><input type='password' name='pass' id='pass'></tr>
	<tr><td>Ime:</td><td><input type='text' name='name' id='name'></tr>
	<tr><td>Prezime:</td><td><input type='text' name='surname' id='surname'><br/>
	<tr><td>Adresa:</td><td><input type='text' name='adresa' id='adresa'></tr>
	<tr><td>Mobilni telefon:</td><td><input type='text' name='mobilni' id='mobilni'></tr>
	<tr><td>Web sajt:</td><td><input type='text' name='sajt' id='sajt'></tr>
	<tr><td>Zvanje:</td><td><select name='zvanje'>
	<option value=''></option>
	<option value='redovni profesor'>Redvni profesor</option>
	<option value='vanredni profesor'>Vanredni profesor</option>
	<option value='docent'>Docent</option>
	<option value='asistent'>Asistent</option>
	<option value='saradnik u nastavi'>Saradnik u nastavi</option>
	<option value='istraživač'>Istraživač</option>
	<option value='laboratorijski inženjer'>Laboratorijski inženjer</option>
	<option value='laboratorijski tehničar'>Laboratorijski tehničar</option>
	</select>
	<tr><td>Broj kabineta:</td><td><input type='text' name='kabinet' id='kabinet'></tr>
	<tr><td>Status:</td><td><input type='checkbox' name='status' id='status'></tr>
	<tr><td>Link ka slici:</td><td><input type='text' name='slika' id='slika'></tr>
	<tr><td>Biografija:</td><td><textarea name='biografija' id='biografija'></textarea></td></tr>
	<tr><td><input type='submit' value='Dodaj' name='dodaj' id='dodaj' onclick='return dodaj_nast();'><br/></td></tr>
	</table>
	<?php
	}
	echo "</form>";
	echo "<div id='obav'></div>";
	include('../include/footer.html');
?>

	</div>
</doby>
<?php
}

include('../include/db_disconn.php');
?>