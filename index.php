<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class='container'>
<?php
session_start();
header('Content-type: text/html; charset=utf-8');
    include('header.php');
    
    include('login.php');
    
    
include('footer.html');
    ?>
    </div>
</doby>