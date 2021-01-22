<head>
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<title>Osnovne</title>
</head>

<body>
	<div class='container'>
<?php
	session_start();
	header('Content-type: text/html; charset=utf-8');
	include('header.php');
	include('login.php');
	include('menu.html');

	include('db_conn.php');
	$hash = [];
	if(isset($_SESSION['role']) && $_SESSION['role']=='Student osnovnih studija'){
		echo "<h4>Moji predmeti</h4>";
		$result = mysqli_query($conn, "select * from prati_predmet,predmet where prati_predmet.id_student ='".$_SESSION['email']."' and prati_predmet.sifra_predmet=predmet.sifra_predmeta");
		if(mysqli_num_rows($result)){
			while($row = mysqli_fetch_assoc($result)){
				$hash[$row['sifra_predmeta']] = true;
				echo " &nbsp &nbsp<a href='predmet?sifra=".$row['sifra_predmeta']."'>".$row['sifra_predmeta']." ".$row['naziv']." ".$row['fond_casova']."</a><br/>";
			}
		}
		else
			echo "Niste odabrali ni jedan predmet!!<br/>";
	echo "<h4>Ostali predmeti</h4>";
	}
	
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
				echo " &nbsp &nbsp".$row['sifra_predmeta']." ".$row['naziv']." ".$row['fond_casova']."<br/>";
			}
		}
	}
	include('db_disconn.php');
	include('footer.html');
	?>
	</div>
</doby>