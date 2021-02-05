<head>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <title>Profil</title>
</head>

<body>
    <div class='container'>
<?php
	//azuriranje licnih informacija
    session_start();
	header('Content-type: text/html; charset=utf-8');
	if(!isset($_SESSION['email'])|| !($_SESSION['type'] == 'z'))
		header('Location: ../');
	
	include('../include/db_conn.php');
	include('header_nast.php');
	include('menu_nast.html');
	include('../include/login.php');
	$result = mysqli_query($conn,"select * from zaposleni where email='".$_SESSION['email']."'");
	$row = mysqli_fetch_assoc($result);
	if(isset($_POST['potvrda'])){
		if(($_POST['adresa']!="")and $_POST['adresa']!=$row['adresa'])
			mysqli_query($conn,"update zaposleni set adresa='".$_POST['adresa']."' where email='".$_SESSION['email']."'");
		if(($_POST['mobilni']!="")and $_POST['mobilni']!=$row['mobilni'])
			mysqli_query($conn,"update zaposleni set mobilni='".$_POST['mobilni']."' where email='".$_SESSION['email']."'");
		if(($_POST['broj_kabineta']!="")and $_POST['broj_kabineta']!=$row['broj_kabineta'])
			mysqli_query($conn,"update zaposleni set broj_kabineta='".$_POST['broj_kabineta']."' where email='".$_SESSION['email']."'");
			if(($_POST['biografija']!="")and $_POST['biografija']!=$row['biografija'])
				mysqli_query($conn,"update zaposleni set biografija='".$_POST['biografija']."' where email='".$_SESSION['email']."'");
		header("Location:#");
	}
	echo "<form method='post' action=''>";
	echo "<table>";
	echo "<tr><td>Adresa: </td><td><input type='text' name='adresa' placeholder='".$row['adresa']."'></td></tr>";
	echo "<tr><td>Broj telefona: </td><td><input type='text' name='mobilni' placeholder='".$row['mobilni']."'></td></tr>";
	echo "<tr><td>Broj kabineta: </td><td><input type='text' name='broj_kabineta' placeholder='".$row['broj_kabineta']."'></td></tr>";
	echo "<tr><td>Biografija: </td><td><textarea name='biografija' resizable='true' placeholder='".$row['biografija']."'></textarea></td></tr>";
	echo "<tr><td colspan='2' id='centar'><input type='submit' name = 'potvrda' value='Potvrdi'></td></tr></table></form>";

	include('../include/footer.html');
	include('../include/db_disconn.php');
    ?>
    </div>
</doby>