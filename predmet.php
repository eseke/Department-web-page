<head>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Kontakt</title>
</head>

<body>
    <div class='container'>
<?php
    session_start();
    include('db_conn.php');
    if(!isset($_SESSION['email']) || !isset($_GET['sifra']))
        header('Location: osnovne');
    else{
        $result = mysqli_query($conn,"select predmet.naziv from prati_predmet,predmet where prati_predmet.id_student='".$_SESSION['email']."' and prati_predmet.sifra_predmet='".$_GET['sifra']."' and prati_predmet.sifra_predmet=predmet.sifra_predmeta");
        if(!mysqli_num_rows($result))
            header('Location: osnovne');
    }
    header('Content-type: text/html; charset=utf-8');
    include('header_pred.php');
    include('login.php');
    include('menu_pred.php');

    if(isset($_GET['str'])&&file_exists($_GET['str'].".php"))
        include($_GET['str'].".php");
    else if(isset($_GET['str']))
        header("Location: ?sifra=".$_GET['sifra']);
    else
        include('obavestenja_pred.php');

    include('footer.html');
    include('db_disconn.php');
    ?>
    </div>
</doby>