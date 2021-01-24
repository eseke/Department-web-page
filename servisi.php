<head>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Servisi</title>
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
<div id='servisi'>
    <a href='http://www.etf.rs/' target="_blank">Fakultet</a><br/>
    <a href='http://student.etf.rs/' target="_blank">Studentski servis</a><br/>
    <a href='http://lists.etf.rs/' target="_blank">Mejling lista</a><br/>
    <a href='http://rti.etf.rs/sale' target="_blank">Paviljoni laboratorija</a><br/>
</div>
<?php
    include('include/footer.html');
    ?>
    </div>
</doby>