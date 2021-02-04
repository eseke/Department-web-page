<?php
session_start();
if(isset($_POST['old_pass'])){
    include('include/db_conn.php');
    $result = mysqli_query($conn,"select * from korisnik where email='".$_SESSION['email']."'");
    $row = mysqli_fetch_assoc($result);
    if($row['pass']!=$_POST['old_pass'])
        echo "Nije dobra stara šifra!";
    else{
        if(mysqli_query($conn,"update korisnik set pass='".$_POST['new_pass1']."' where email='".$_SESSION['email']."'")){
            echo "Uspešno je promenjena šifra!";
            include_once('include/logout.php');
        }
        else 
            echo "Došlo je do greške!";
    }
    include('include/db_disconn.php');
}
else{
?>
<head>
    <title>Početna</title>

    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
	<script src="/script/ajax.js"></script>
	<script src="/script/script.js"></script>
</head>

<body>
    <div class='container'>
<?php
    if(!isset($_SESSION['type']))
        header('Location:/');
    header('Content-type: text/html; charset=utf-8');
	$passpage = true;
    include('include/header.php');
    include('include/login.php');
    
	if(!isset($_SESSION['first']))
		include('include/menu.html');
    ?>
    <form id='forma' type='post'action=''>
    <table>
    <tr><td>Trenutna šifra:</td><td><input type='password' id='old_pass' name='old_pass'></td></tr>
    <tr><td>Nova šifra:</td><td><input type='password' id='new_pass1' name='new_pass1'></td></tr>
    <tr><td>Trenutna šifra:</td><td><input type='password' id='new_pass2' name='new_pass2'></td></tr>
    </table>
    <input type='submit' value='Promeni' onclick='return change_pass();'>
    </form>
    <div id='obav'></div>
    <?php
    include('include/footer.html');
    ?>
    </div>
    
</doby>

<?php
}
?>