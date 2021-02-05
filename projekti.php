<head>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Obaveštenja</title>
</head>

<body>
    <div class='container'>
<?php
    session_start();
    header('Content-type: text/html; charset=utf-8');
    include('include/header.php');
    include('include/login.php');
    include('include/menu.html');
    include('ProjObavZap/menu_proj.php');
    include('include/db_conn.php');
    if(isset($_GET['tip'])){//ispis projekata neke kategorije
        $result = mysqli_query($conn,"SELECT * from kategorija_projekta where kategorija_projekta.naziv='".$_GET['tip']."'");
        if(!mysqli_num_rows($result)){
            header("Location: obavestenja");
        }else{
            $result = mysqli_query($conn,"SELECT * from projekat_sajt,korisnik where projekat_sajt.rukovodilac = korisnik.email and projekat_sajt.kategorija='".$_GET['tip']."'");
            while($row = mysqli_fetch_assoc($result)){
                include('ProjObavZap/ispis_projekta.php');
            }
        }
    }else{//ispis svih prjekata
        $result = mysqli_query($conn,"SELECT * from projekat_sajt,korisnik where projekat_sajt.rukovodilac = korisnik.email");
            while($row = mysqli_fetch_assoc($result)){
                include('ProjObavZap/ispis_projekta.php');
            }
    }
    include('include/db_disconn.php');
    include('include/footer.html');
    ?>
    </div>
</doby>