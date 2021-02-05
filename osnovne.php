<head>
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" href="style/style.css">
	<title>Osnovne</title>
</head>

<body>
	<div class='container'>
<?php
	session_start();
	header('Content-type: text/html; charset=utf-8');
	include('include/header.php');
	include('include/login.php');
	include('include/menu.html');

	include('include/db_conn.php');
	if(isset($_SESSION['email'])&&isset($_GET['zaprati'])){//Zaprati predmet
		mysqli_query($conn,"insert into prati_predmet(id_student, sifra_predmet) values('".$_SESSION['email']."','".$_GET['zaprati']."')");
	}else if(isset($_SESSION['email'])&&isset($_GET['otprati'])){//Otprati predmet
		mysqli_query($conn,"delete from prati_predmet where id_student='".$_SESSION['email']."' and sifra_predmet='".$_GET['otprati']."'");
	}
	$hash = [];// Ova promenljiva pomaza da se moji predmeti neispisu kod ostalih
	if(isset($_SESSION['role']) && $_SESSION['role']=='Student osnovnih studija'){// Ukoliko je ulogovan student osnovnih studija ispisuju se njegovi predmeti
		echo "<h4>Moji predmeti</h4>";
		$result = mysqli_query($conn, "select * from prati_predmet,predmet where prati_predmet.id_student ='".$_SESSION['email']."' and prati_predmet.sifra_predmet=predmet.sifra_predmeta");
		if(mysqli_num_rows($result)){
			while($row = mysqli_fetch_assoc($result)){
				$hash[$row['sifra_predmeta']] = true;
				echo " &nbsp &nbsp<a href='predmet?sifra=".$row['sifra_predmeta']."'>".$row['sifra_predmeta']." ".$row['naziv']." ".$row['fond_casova']."</a> &nbsp<a href='?otprati=".$row['sifra_predmeta']."'>Otprati</a><br/>";
			}
		}
		else
			echo "Niste odabrali ni jedan predmet!!<br/>";
	echo "<h4>Ostali predmeti</h4>";
	}
    //Ispisivanje svih predmeta ili samo predmeta koje student nije odabrao ukoliko je ulogovan master student
	$result = mysqli_query($conn,'SELECT * FROM `nastavni_plan`,`predmet` WHERE `nastavni_plan`.`sifra_predmeta`=`predmet`.`sifra_predmeta` order by `nastavni_plan`.`semestar` asc');
	if(mysqli_num_rows($result)){
		$godina = 0;
		$semestar = 0;
		while($row = mysqli_fetch_assoc($result)){
			if(!$row['aktivan'])
				continue;
			if($row['semestar']>8)
				break;
			if(!isset($hash[$row['sifra_predmeta']])){
				if($row['semestar']/2>$godina){
					$godina = round($row['semestar']/2,0,PHP_ROUND_HALF_UP);
					echo $godina." godina<br/>";
				}
				if($row['semestar']>$semestar){
					$semestar = $row['semestar'];
					echo " &nbsp".$semestar." semestar<br/>";
				}
			
				$hash[$row['sifra_predmeta']] = true;
				if(isset($_SESSION['role']) && $_SESSION['role']=='Student osnovnih studija')
					echo " &nbsp &nbsp".$row['sifra_predmeta']." ".$row['naziv']." ".$row['fond_casova']."&nbsp<a href='?zaprati=".$row['sifra_predmeta']."'>Zaprati</a><br/>";
				else
					echo " &nbsp &nbsp".$row['sifra_predmeta']." ".$row['naziv']." ".$row['fond_casova']."<br/>";
			}
		}
	}
	include('include/db_disconn.php');
	include('include/footer.html');
	?>
	</div>
</doby>