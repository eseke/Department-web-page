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
	$result = mysqli_query($conn,'SELECT * FROM `nastavni_plan`,`predmet` WHERE `nastavni_plan`.`sifra_predmeta`=`predmet`.`sifra_predmeta` order by `nastavni_plan`.`semestar` asc');
	if(mysqli_num_rows($result)){
		$hash = [];
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