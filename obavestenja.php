<head>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Obaveštenja</title>
</head>

<body>
    <div class='container'>
<?php
    session_start();
    header('Content-type: text/html; charset=utf-8');
    include('header.php');
    include('login.php');
    include('menu.html');
    include('menu_obav.php');
    include('db_conn.php');
    if(isset($_GET['tip'])){
        $result = mysqli_query($conn,"SELECT * from kategorija_obavestenja where kategorija_obavestenja.naziv='".$_GET['tip']."'");
        if(!mysqli_num_rows($result)){
            header("Location: obavestenja");
        }else{
            $result = mysqli_query($conn,"SELECT * from obavestenje_sajt,korisnik where obavestenje_sajt.autor = korisnik.email and obavestenje_sajt.kategorija='".$_GET['tip']."'");
            while($row = mysqli_fetch_assoc($result)){
                include('ispis_obavestenja.php');
            }
        }
    }else{
        $result = mysqli_query($conn,"SELECT * from obavestenje_sajt,korisnik where obavestenje_sajt.autor = korisnik.email");
            while($row = mysqli_fetch_assoc($result)){
                include('ispis_obavestenja.php');
            }
    }
    include('db_disconn.php');
    include('footer.html');
    ?>
    </div>
</doby>