<head>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Kontakt</title>
</head>

<body>
    <div class='container'>
<?php
    session_start();
    include('include/db_conn.php');
    if(isset($_SESSION['email']) && isset($_GET['sifra']) && isset($_POST['Zelim'])){
        mysqli_query($conn,"insert into prati_predmet (id_student, sifra_predmet) values ('".$_SESSION['email']."','".$_GET['sifra']."')");
        header('Location:#');
    }
    if(!isset($_SESSION['email']) || !isset($_GET['sifra']))
        header('Location: osnovne');
    else{
        $result = mysqli_query($conn,"select predmet.naziv from prati_predmet,predmet where prati_predmet.id_student='".$_SESSION['email']."' and prati_predmet.sifra_predmet='".$_GET['sifra']."' and prati_predmet.sifra_predmet=predmet.sifra_predmeta");
        header('Content-type: text/html; charset=utf-8');
        if(!mysqli_num_rows($result)){
            include('include/header.php');
            include('include/login.php');
            include('include/menu.html');
            echo "Da li želite da se prijavite na predmet ".$_GET['sifra'];
            ?>
                <form method='post' action="/predmet?sifra=<?php echo $_GET['sifra']?>">
                    <input type="submit" value="Želim" name='Zelim'/>
                </form>
            <?php
        }
        else{
            include('predmeti/header_pred.php');
            include('include/login.php');
            include('predmeti/menu_pred.php');
            if(isset($_GET['str']) && $_GET['str']=="info")
                include("predmeti/info.php");
            else if(isset($_GET['str'])&& ($_GET['str']=="predavanja" || $_GET['str']=="vezbe" || $_GET['str']=="rokovi"))
                include("predmeti/ispis_fajlova.php");
            else if(isset($_GET['str']))
                header("Location: ?sifra=".$_GET['sifra']);
            else
                include('predmeti/obavestenja_pred.php');

            
        }
        include('include/footer.html');
        include('include/db_disconn.php');
    }
    ?>
    </div>
</doby>