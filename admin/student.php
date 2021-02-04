<?php
#var_dump($_POST);
if(isset($_POST['id']) && isset($_POST['name'])){
	include_once("../include/db_conn.php");
	$ind = explode('/',$_POST['indeks']);
	$email = strtolower($_POST['surname'][0]).strtolower($_POST['name'][0]).$ind[0][2].$ind[0][3].$ind[1].$_POST['tip_studija']."@student.etf.rs";
	$res1 = mysqli_query($conn,"update korisnik set email='".$email."',".($_POST['pass']!=''?"pass='".$_POST['pass']."',":"")."name='".$_POST['name']."',surname='".$_POST['surname']."',status='".(isset($_POST['status'])?"1":"0")."',type='s' where email='".$_POST['id']."'");
	$res2 = mysqli_query($conn,"update student set email='".$email."',indeks = '".$_POST['indeks']."',tip_studija='".$_POST['tip_studija']."' where email='".$_POST['id']."'");
	if($res1 && $res2)
		echo "1";
	include_once("../include/db_disconn.php");
}
elseif(isset($_POST['name'])){
	include_once("../include/db_conn.php");
	$ind = explode('/',$_POST['indeks']);
	$email = $_POST['surname'][0].$_POST['name'][0].$ind[0][2].$ind[0][3].$ind[1].$_POST['tip_studija']."@student.etf.rs";
	$res1 = mysqli_query($conn,"insert into korisnik (email,pass,name,surname,status,first_access,type) values ('".$email."','".$_POST['pass']."','".$_POST['name']."','".$_POST['surname']."','".(isset($_POST['status'])?"1":"0")."',1,'s')");
	$res2 = mysqli_query($conn,"insert into student(email,indeks,tip_studija) values('".$email."','".$_POST['indeks']."','".$_POST['tip_studija']."')");
	if($res1 && $res2)
		echo "1";
	include_once("../include/db_disconn.php");
}

else if(isset($_POST['id'])){
	include_once('../include/db_conn.php');
	$result = mysqli_query($conn,"select * from student, korisnik where student.email=korisnik.email and student.email='".$_POST['id']."'");
	$row = mysqli_fetch_assoc($result);
	echo "<table>";
	echo "<tr><td>Email:</td><td>".$row['email']."</td></tr>";
	echo "<tr><td>Nova šifra:</td><td><input type='pass' name='pass'></tr>";
	echo "<tr><td>Ime:</td><td><input type='text' name='name' value='".$row['name']."'></tr>";
	echo "<tr><td>Prezime:</td><td><input type='text' name='surname' value='".$row['surname']."'><br/>";
	echo "<tr><td>Broj indeksa:</td><td><input type='text' name='indeks' value='".$row['indeks']."'></tr>";
	echo "
	<tr><td>Tip studija:</td><td><select name='tip_studija'>
	<option value=''></option>
	<option value='d' ".($row['tip_studija']=='d'?"selected":"").">Osnovne akademske</option>
	<option value='m' ".($row['tip_studija']=='m'?"selected":"").">Master akademske</option>
	<option value='p' ".($row['tip_studija']=='p'?"selected":"").">Doktorske akademske</option>
	</select>
	";
	echo "<tr><td>Status:</td><td><input type='checkbox' name='status' ".($row['status']?"checked":"")."></tr>";
	echo "</table>";
	echo "<input type='submit' value='Ažuriraj' name='dodaj' onclick='return azur_stud();'><br/>";

}else{
?>
	<head>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
	<script src="../script/ajax.js"></script>
	<script src="../script/script.js"></script>
    <title>Kontakt</title>
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
	if(!isset($_GET['tip']) || !($_GET['tip']=='nov'||$_GET['tip']=='azuriraj'))
		header('Location:korisnici');
	?>
	<form id='forma' action='' type='post'>
	
	<?php 
		if($_GET['tip']=='azuriraj'){
	?>
	Odaberi studenta: <select id='id' name='id' onchange="ispis_stud()">
	<option value=''></option>
	<?php

	$result = mysqli_query($conn,"select * from student, korisnik where student.email=korisnik.email");
	while($row=mysqli_fetch_assoc($result))
		echo "<option id='".$row['email']."' value='".$row['email']."'>".$row['name']." ".$row['surname']."</option>";
	echo "</select>";
	echo "<div id='sadrzaj'></div>";
	}else{		
	?>
	
	<table>
	<tr><td>Šifra:</td><td><input type='password' name='pass' id='pass'></tr>
	<tr><td>Broj indeksa:</td><td><input type='text' name='indeks' id='indeks'></tr>
	<tr><td>Ime:</td><td><input type='text' name='name' id='name'></tr>
	<tr><td>Prezime:</td><td><input type='text' name='surname' id='surname'><br/>
	<tr><td>Tip studija:</td><td><select name='tip_studija'>
	<option value=''></option>
	<option value='d'>Osnovne akademske</option>
	<option value='m'>Master akademske</option>
	<option value='p'>Doktorske akademske</option>
	</select>
	<tr><td>Status:</td><td><input type='checkbox' name='status' id='status'></tr>
	<tr><td><input type='submit' value='Dodaj' name='dodaj' id='dodaj' onclick='return dodaj_stud();'><br/></td></tr>
	</table>
	<?php
	}
	echo "</form>";
	echo "<div id='obav'></div>";
	include('../include/footer.html');
	include('../include/db_disconn.php');
?>

	</div>
</doby>
<?php
}
?>