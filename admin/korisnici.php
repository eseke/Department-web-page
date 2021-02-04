<head>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
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

	
	echo "<a href='nastavnik?tip=nov'>Dodavanje nastavnika</a><br/>";
	echo "<a href='nastavnik?tip=azuriraj'>Azuriranje nastavnika</a><br/>";
	echo "<a href='student?tip=nov'>Dodavanje studenta</a><br/>";
	echo "<a href='student?tip=azuriraj'>Ažuriranje studenta</a>";

	include('../include/footer.html');
	include('../include/db_disconn.php');
?>

	</div>
</doby>