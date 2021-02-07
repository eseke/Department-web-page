<?php
if(isset($_FILES['fajl'])){//ajax dodavanje studenata preko fajla
	include_once('../include/db_conn.php');
	$fajl = fopen($_FILES['fajl']['tmp_name'],'r');
	$tmp = explode('.',$_FILES['fajl']['name']);
	if(end($tmp)!= 'csv')
		echo "Niste izabrali CSV fajl!";
	else{
		$res = true;
		while($tmp = fgetcsv($fajl,1000,';')){
			$res = mysqli_query($conn,"insert into korisnik(email,pass,name,surname,status,first_access,type) values ('".$tmp[0]."@student.etf.rs','".$tmp[1]."','".$tmp['2']."','".$tmp['3']."',1,1,'s')") && $res;
			$res = mysqli_query($conn,"insert into student(email,indeks,tip_studija) values('".$tmp[0]."@student.etf.rs','20".substr($tmp[0],2,2)."/".substr($tmp[0],4,4)."','".$tmp[0][8]."')") && $res;
		}
		if($res)
			echo "Uspešno su dodati studenti!";
		else
			echo "Došlo je do greške!";
	}
	fclose($fajl);
	include_once('../include/db_disconn.php');
}else{//ucitavanje tranice
?>
<head>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <title>Korisnici</title>
	<script src="../script/ajax.js"></script>
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

	
	echo "<a href='nastavnik?tip=nov'>Dodavanje zaposlenog</a><br/>";
	echo "<a href='nastavnik?tip=azuriraj'>Azuriranje zaposlenog</a><br/>";
	echo "<a href='student?tip=nov'>Dodavanje studenta</a><br/>";
	echo "<a href='student?tip=azuriraj'>Ažuriranje studenta</a>";
	
	echo "<form id='forma' enctype='multipart/form-data' method='post' action=''>";
	echo "Učitavanje studenata iz csv fajla: <input type='file' name='fajl' accept='.csv' OnChange='fajl_stud()'>";
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