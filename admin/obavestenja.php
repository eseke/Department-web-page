<?php
	session_start();
	header('Content-type: text/html; charset=utf-8');
	if(!isset($_SESSION['email'])|| !($_SESSION['type'] == 'a'))
		header('Location: ../');
	if (isset($_POST['kat'])){
		include_once('../include/db_conn.php');
		echo mysqli_query($conn,"insert into obavestenje_sajt (kategorija,naslov,sadrzaj,datum_objave,autor) value ('".$_POST['kat']."','".$_POST['naslov']."','".substr($_POST['sadrzaj'], 3, -4)."','".date("Y-m-d")."','".$_SESSION['email']."')");
	}else if(isset($_POST['nova_kat'])){
		include_once('../include/db_conn.php');
		echo mysqli_query($conn,"insert into kategorija_obavestenja (naziv) value ('".$_POST['nova_kat']."')");

	}else{
		?>

		<head>
			<link rel="stylesheet" href="../style/bootstrap.min.css">
			<link rel="stylesheet" href="../style/style.css">
			<script src='../script/ajax.js'></script>
			<script src='../script/script.js'></script>
			<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
			
			<title>Kontakt</title>
		</head>

		<body>
			<div class='container'>
		<?php
		include_once('../include/db_conn.php');
		include('header_admin.php');
		include('menu_admin.html');
		include('../include/login.php');

		echo "<h4>Dodaj kategoriju obavestenja</h4>";
		echo "<span>";
		echo "Naziv kategorije: <input type='text' id='nova_kat'>";
		echo "<input type='submit' value='Dodaj' onclick='dodaj_kat();'";
		echo "</span>";
		echo "<div id='res'></div>";

		echo "<h4>Dodaj obavestenje</h4>";
		echo "Izaberite kategoriju obavestenja: ";
		$result = mysqli_query($conn,"select * from kategorija_obavestenja");
		echo "<select id='kat' name='kat'>";
		echo "<option value=''></option>";
		while($row = mysqli_fetch_assoc($result))
			echo "<option value='".$row['naziv']."'>".$row['naziv']."</option>";
		echo "</select><br/>";
		echo "Naslov obaveštenja: <input type='text' id='naslov'><br/>";
		echo "Tekst obaveštenja:";
		echo "<textarea name='sadrzaj' id='editor'>".$row['sadrzaj']."</textarea>";
		echo "<input type='submit' value='Dodaj obaveštenje' onclick='return dodaj_obav()'>";
		echo "<div id='obavestenja'></div>";
		?>
		<script>
		let MyEditor;
    	ClassicEditor
        .create( document.querySelector( '#editor' ),{
			toolbar: ['bold','italic', '|','bulletedList', 'numberedList']
		} )
		.then(editor => {
        	MyEditor=editor;
    	})
        .catch( error => {
            console.error( error );
        } );
		</script>

		<?php
		include('../include/footer.html');
		?>
	</div>
</doby>
		<?php
	}
	include('../include/db_disconn.php');
?>