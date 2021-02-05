<head>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
	<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="../script/script.js"></script>
	
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
	if(!isset($_SESSION['email'])|| !($_SESSION['type'] == 'z'))
		header('Location: ../');
	if($_GET['id']!=0){
		$result = mysqli_query($conn,"select * from obavestenje_predmet,grupa,drzi_predmet where obavestenje_predmet.id_obavestenja =".$_GET['id']." and obavestenje_predmet.id_predmeta=grupa.sifra_predmeta ".
		"and grupa.id=drzi_predmet.id_grupe and drzi_predmet.id_nastavnika='".$_SESSION['email']."'");
		if(!mysqli_num_rows($result))
			header('Location: ../');
	}
	if(isset($_POST['obrisi'])){
		$result = mysqli_query($conn,"select * from fajl_uz_obavestenje where id_obavestenja=".$_GET['id']);
		if(mysqli_num_rows($result)){
			while($row=mysqli_fetch_assoc($result)){
				unlink($row['putanja']);
				mysqli_query($conn,"delete from fajl_uz_obavestenje where idfajla=".$row['idfajla']);
			}
		}
		mysqli_query($conn,"delete from obavestenje_predmet where id_obavestenja=".$_GET['id']);
		header('Location:obav_pred');
	}
	if(isset($_POST['potvrda']) && isset($_POST['naslov']) && isset($_POST['datum']) && isset($_POST['sadrzaj'])){
		$tmp = explode('.',$_POST['datum']);
		if($_GET['id']==0){
			mysqli_query($conn,"insert into obavestenje_predmet (id_predmeta,naslov,sadrzaj,datum_objave,id_nastavnika) values ('".$_POST['odabir']."','".$_POST['naslov']."','".substr($_POST['sadrzaj'], 3, -4)."','".$tmp[2]."-".$tmp[1]."-".$tmp[0]."','".$_SESSION['email']."')");
			$result = mysqli_query($conn,"select id_obavestenja from obavestenje_predmet where id_predmeta='".$_POST['odabir']."' and naslov='".$_POST['naslov']."' and sadrzaj='".substr($_POST['sadrzaj'], 3, -4)."' and datum_objave='".$tmp[2]."-".$tmp[1]."-".$tmp[0]."' and id_nastavnika='".$_SESSION['email']."'");
			$row = mysqli_fetch_assoc($result);
			$id_obav = $row['id_obavestenja'];
			$total = count($_FILES['fajlovi']['name']);
			if($_FILES['fajlovi']['tmp_name'][0]!=""){
				for($i=0;$i<$total;$i++){
					move_uploaded_file($_FILES['fajlovi']['tmp_name'][$i], "../predmeti/".$_POST['odabir']."/".$_FILES['fajlovi']['name'][$i]);
					mysqli_query($conn,"insert into fajl_uz_obavestenje(id_obavestenja,putanja,ime_fajla) values(".$id_obav.",'../predmeti/".$_POST['odabir']."/".$_FILES['fajlovi']['name'][$i]."','".$_POST['fajl'.$i]."')");
				}
			}
		}else{
			mysqli_query($conn,"UPDATE obavestenje_predmet SET naslov='".$_POST['naslov']."', sadrzaj='".substr($_POST['sadrzaj'], 3, -4)."',datum_objave='".$tmp[2]."-".$tmp[1]."-".$tmp[0]."' where id_obavestenja=".$_GET['id']);
			if(isset($_POST['st_fajl'])){
				for($i=0;$i<count($_POST['st_fajl']);$i++){
					$result = mysqli_query($conn,"select * from fajl_uz_obavestenje where idfajla=".$_POST['st_fajl'][$i]);
					$row = mysqli_fetch_assoc($result);
					unlink($row['putanja']);
					mysqli_query($conn,"delete from fajl_uz_obavestenje where idfajla=".$_POST['st_fajl'][$i]);
				}
			}
			$result = mysqli_query($conn,"select * from obavestenje_predmet where id_obavestenja=".$_GET['id']);
			$row = mysqli_fetch_assoc($result);
			$total = count($_FILES['fajlovi']['name']);
			if($_FILES['fajlovi']['tmp_name'][0]!=""){
				for($i=0;$i<$total;$i++){
					move_uploaded_file($_FILES['fajlovi']['tmp_name'][$i], "../predmeti/".$row['id_predmeta']."/".$_FILES['fajlovi']['name'][$i]);
					mysqli_query($conn,"insert into fajl_uz_obavestenje(id_obavestenja,putanja,ime_fajla) values(".$_GET['id'].",'../predmeti/".$row['id_predmeta']."/".$_FILES['fajlovi']['name'][$i]."','".$_POST['fajl'.$i]."')");
				}
			}
		}
		header('Location:obav_pred');
	}
	echo "<form enctype='multipart/form-data' method='post' action=''>";
	if($_GET['id']!=0){
		$result = mysqli_query($conn,"select * from obavestenje_predmet where id_obavestenja=".$_GET['id']);
		$row = mysqli_fetch_assoc($result);
	}else{
		$row['naslov']=$row['sadrzaj']=$row['datum_objave']="";
		?>
		Odaberi predmet:
		<select name='odabir' id='odabir'>
			<option value=''></option>
		<?php
		$result = mysqli_query($conn,"select DISTINCT predmet.sifra_predmeta, predmet.naziv from predmet,drzi_predmet,grupa where drzi_predmet.id_nastavnika='".$_SESSION['email']."' and drzi_predmet.id_grupe=grupa.id and grupa.sifra_predmeta=predmet.sifra_predmeta");
		while($res=mysqli_fetch_assoc($result))	
			echo "<option value='".$res['sifra_predmeta']."'>".$res['naziv']."</option>";
		?>
	</select><br/>
	<?php
	}
	echo "Naslov: <input type='text' id='naslov' name='naslov' value='".$row['naslov']."'><br/>";
	echo "Datum: <input type='text' name='datum' id='datepicker' autocomplete='off'><br/>";
	echo "<textarea name='sadrzaj' id='editor'>".$row['sadrzaj']."</textarea>";
	if($_GET['id']!=0){
		$result1 = mysqli_query($conn,"select * from fajl_uz_obavestenje where id_obavestenja=".$_GET['id']." order by ime_fajla asc");
		if(mysqli_num_rows($result1)){
			echo "Odaberite fajlove koje hoćete da uklonite:<br/>";
			while($row1=mysqli_fetch_assoc($result1)){
				echo "<input type='checkbox' name='st_fajl[]' value='".$row1['idfajla']."'>".$row1['ime_fajla']."<br/>";
			}
		}
	}
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
	
	$( function() {
		$( "#datepicker" ).datepicker();
		$( "#datepicker" ).datepicker( "option", "showAnim","slideDown");
		$( "#datepicker" ).datepicker( "option", "dateFormat", "dd.mm.yy." );
		$( "#datepicker" ).datepicker("option",  "minDate",new Date(<?php echo "'".$row['datum_objave']."'";?>));
		$( "#datepicker" ).datepicker("setDate",new Date(<?php  echo $_GET['id']==0?"":$row['datum_objave'];?>));
	} );
	</script>
	<input id='fajlovi' type="file" name="fajlovi[]" multiple="multiple" OnChange='fja()' />
	<div id='imena'></div>
	<input type='Submit' name='potvrda'  onclick='return proveri_formu()' id='potvrda' value='<?php  echo $_GET['id']==0?"Postavi obaveštenje":"Izmeni obaveštenje";?>'>
	<?php
		if($_GET['id']!=0 and $_SESSION['email']==$row['id_nastavnika']){
			echo "<input type='Submit' name='obrisi' id='obrisi' value='Obrisi obavestenje'>";
		}
	?>
	</form>
	<div id='obavestenja'></div>
	<?php
	include('../include/db_disconn.php');
	include('../include/footer.html');
    ?>
    </div>
</doby>