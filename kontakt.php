<head>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Kontakt</title>
</head>

<body>
    <div class='container'>
<?php
    session_start();
    header('Content-type: text/html; charset=utf-8');
    include('include/header.php');
    include('include/login.php');
    include('include/menu.html');
?>
<div id='kontakt'>
    dr Nenad Korolija<br/>
    kabinet: Paviljon, 26<br/>
    tel: +381 11 3218389<br/>
    e-mail: <a href='mailto:nenadko@etf.rs'id='kontakt1'>nenadko@etf.rs</a>
</div>
<?php
    include('include/footer.html');
    ?>
    </div>
</doby>