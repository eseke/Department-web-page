<head>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Kontakt</title>
</head>

<body>
    <div class='container'>
<?php
    session_start();
    header('Content-type: text/html; charset=utf-8');
    include('header.php');
    include('login.php');
    include('menu.html');
    echo "dr Nenad Korolija<br/>";
    echo "kabinet: Paviljon, 26<br/>";
    echo "tel: +381 11 3218389<br/>";
    echo "e-mail: nenadko@etf.rs";

    include('footer.html');
    ?>
    </div>
</doby>