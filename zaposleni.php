<head>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class='container'>
<?php
    session_start();
    header('Content-type: text/html; charset=utf-8');
    include('header.php');
    include('login.php');
    include('menu.html');

    if(isset($_GET['id'])){
       include('zaposleni_jedan.php');
    }else
        include('zaposleni_svi.php');

    include('footer.html');
?>
    </div>
</doby>