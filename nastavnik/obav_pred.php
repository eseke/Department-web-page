<head>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
	<script src='../script/ajax.js'></script>
    <title>Obaveštenja</title>
</head>

<body>
    <div class='container'>
<?php
    session_start();
	header('Content-type: text/html; charset=utf-8');
	if(!isset($_SESSION['email'])|| !($_SESSION['type'] == 'z'))
		header('Location: ../');
	
	include('../include/db_conn.php');
	include('header_nast.php');
	include('menu_nast.html');
	include('../include/login.php');
	?>
	<a href='izmeni_obavestenje?id=0'> Dodaj novo obavestenje</a><br/>
	Odaberi predmet:<form autocomplete="off" id='predmet'>
	<select id='odabir'onchange='loadNotifications()' >
		<option value=''></option>
	<?php
	//odabir predmeta za koji se prikazuju obavestenja
	$result = mysqli_query($conn,"select DISTINCT predmet.sifra_predmeta, predmet.naziv from predmet,drzi_predmet,grupa where drzi_predmet.id_nastavnika='".$_SESSION['email']."' and drzi_predmet.id_grupe=grupa.id and grupa.sifra_predmeta=predmet.sifra_predmeta");
	while($res=mysqli_fetch_assoc($result))	
		echo "<option value='".$res['sifra_predmeta']."'>".$res['naziv']."</option>";
	?>
	</select><br/>
	</form>
	<span id='obavestenja'></span>
	<?php
	include('../include/db_disconn.php');
	include('../include/footer.html');
    ?>
    </div>
</doby>