<head>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class='container'>
<?php
    session_start();
    header('Content-type: text/html; charset=utf-8');
    include('include/header.php');
    include('include/login.php');
    include('include/menu.html');

    if(isset($_GET['id'])){//ukoliko je odabran jedan nastavnik o se ispisuje
       include('ProjObavZap/zaposleni_jedan.php');
    }else//isis svih zaposlenih
        include('ProjObavZap/zaposleni_svi.php');

    include('include/footer.html');
?>
    </div>
</doby>