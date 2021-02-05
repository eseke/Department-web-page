<head>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
	<link rel="stylesheet" href="../style/style.css">
	<script src='../script/ajax.js'></script>
	<script src='../script/script.js'></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
  	
    <title>Moji predmeti</title>
</head>

<body>
    <div class='container'>
<?php
    session_start();
	header('Content-type: text/html; charset=utf-8');
	#var_dump($_POST);

	if(isset($_POST['vidi']) && isset($_POST['val'])){
		include('../include/db_conn.php');
		mysqli_query($conn,"update materijali set vidljiv=".$_POST['val']." where id_materijal=".$_POST['vidi']);
		exit();
	}

	if(isset($_POST['gore'])){
		include('../include/db_conn.php');
		mysqli_query($conn,"update materijali set redosled=".($_POST['gore'])." where redosled=".($_POST['gore']-1)." and sifra_predmeta='".$_POST['odabir_pred']."' and tip_materijala='".$_POST['odabir_sekc']."'");
		mysqli_query($conn,"update materijali set redosled=".($_POST['gore']-1)." where id_materijal=".$_POST['gore_id']);
	}

	if(isset($_POST['dole'])){
		include('../include/db_conn.php');
		mysqli_query($conn,"update materijali set redosled=".($_POST['dole'])." where redosled=".($_POST['dole']+1)." and sifra_predmeta='".$_POST['odabir_pred']."' and tip_materijala='".$_POST['odabir_sekc']."'");
		mysqli_query($conn,"update materijali set redosled=".($_POST['dole']+1)." where id_materijal=".$_POST['dole_id']);
	}

	if(isset($_FILES['fajlovi']) && $_FILES['fajlovi']['tmp_name'][0]!=""){
		include('../include/db_conn.php');
		$total = count($_FILES['fajlovi']['name']);
		$result = mysqli_query($conn,"select * from materijali where materijali.sifra_predmeta='".$_POST['odabir_pred']."' and materijali.tip_materijala='".$_POST['odabir_sekc']."'");
		$redosled = mysqli_num_rows($result);
		for($i=0;$i<$total;$i++){
			move_uploaded_file($_FILES['fajlovi']['tmp_name'][$i], "../predmeti/".$_POST['odabir_pred']."/".$_FILES['fajlovi']['name'][$i]);
			$redosled += 1;
			mysqli_query($conn,"insert into materijali(naslov,putanja,sifra_predmeta,tip_materijala,id_nastavnika,datum,vidljiv,redosled) values('".$_POST['fajl'.$i]."','../predmeti/".$_POST['odabir_pred']."/".$_FILES['fajlovi']['name'][$i]."','".$_POST['odabir_pred']."','".$_POST['odabir_sekc']."','".$_SESSION['email']."','".date("Y-m-d")."',0,".$redosled.")");
		}
	}

	if(isset($_POST['obrisi'])&&$_POST['obrisi']!=''){
		include('../include/db_conn.php');
		$result = mysqli_query($conn,"select * from materijali where id_materijal=".$_POST['obrisi']);
		$row = mysqli_fetch_assoc($result);
		unlink($row['putanja']);
		mysqli_query($conn,"update materijali set redosled=redosled-1 where sifra_predmeta='".$_POST['odabir_pred']."' and tip_materijala='".$_POST['odabir_sekc']."' and redosled>".$row['redosled']);
		mysqli_query($conn,"delete from materijali where id_materijal=".$_POST['obrisi']);
		include('../include/db_disconn.php');
	}
	if(isset($_POST['ESPB'])){
		include('../include/db_conn.php');
		mysqli_query($conn,"update predmet set naziv='".$_POST['naziv']."', fond_casova='".$_POST['br_pred']."+".$_POST['br_vez']."+".$_POST['br_lab']."', broj_ESPB=".$_POST['ESPB'].",cilj_predmeta='".substr($_POST['sadrzaj1'], 3, -4)."',ishod_predmeta='".substr($_POST['ishod1'], 3, -4)."', komentar='".substr($_POST['kom1'], 3, -4)."' where sifra_predmeta='".$_POST['odabir_pred']."'");
		for($i = 1;$i<10;$i++){
			if(isset($_POST['iz/ob'.$i])){
				mysqli_query($conn,"update nastavni_plan set semestar=".$_POST['s'.$i].", Tip_predmeta='".$_POST['iz/ob'.$i]."' where sifra_predmeta='".$_POST['odabir_pred']."' and id_odseka=".$i);
			}
		}
	}

	if(!isset($_SESSION['email'])|| !($_SESSION['type'] == 'z'))
		header('Location: ../');
	
	if(isset($_POST['prom'])||isset($_POST['obrisi'])||isset($_FILES['fajlovi'])){
		if($_POST['odabir_sekc']=="info")
			include('info.php');
		else if($_POST['odabir_sekc']=="predavanja"||$_POST['odabir_sekc']=="predavanja"||$_POST['odabir_sekc']=="vezbe"||$_POST['odabir_sekc']=="rokovi")
			include('fajlovi.php');
	}else{
		include('../include/db_conn.php');
		include('header_nast.php');
		include('menu_nast.html');
		include('../include/login.php');
		?>
		<form id='forma' enctype='multipart/form-data' autocomplete="off" method='get' action=''>
		Odaberi predmet:
		<select name='odabir_pred' id='odabir_pred'onchange='load_info()' >
			<option value=''></option>
		<?php
		$result = mysqli_query($conn,"select DISTINCT predmet.sifra_predmeta, predmet.naziv from predmet,drzi_predmet,grupa where drzi_predmet.id_nastavnika='".$_SESSION['email']."' and drzi_predmet.id_grupe=grupa.id and grupa.sifra_predmeta=predmet.sifra_predmeta");
		while($res=mysqli_fetch_assoc($result))	
			echo "<option value='".$res['sifra_predmeta']."' >".$res['naziv']."</option>";
		?>
		</select>
		Odaberi sekciju:
		<select name='odabir_sekc' id='odabir_sekc'onchange='load_info()' >
			<option value=''></option>
			<option value='info' >Informacije</option>
			<option value='predavanja' >Predavanja</option>
			<option value='vezbe' >Vežbe</option>
			<option value='rokovi' >Ispitna pitanja</option>
		</select>
		
		
		<?php
		echo "<div id='sadrzaj'></div>";
		echo "<div id='obavestenja'></div>";
		echo "</form>";
		include('../include/footer.html');
		include('../include/db_disconn.php');
	}
		?>

    </div>
</doby>