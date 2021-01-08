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

    include('db_conn.php');
    $result = mysqli_query($conn,'SELECT * FROM `nastavni_plan`,`predmet` WHERE `nastavni_plan`.`sifra_predmeta`=`predmet`.`sifra_predmeta` order by `nastavni_plan`.`semestar` asc');
    if(mysqli_num_rows($result)){
        $hash = [];
        while($row = mysqli_fetch_assoc($result)){
            if($row['semestar']<9)
                continue;
            if($row['semestar']>10)
                break;
            if(!isset($hash[$row['sifra_predmeta']])){
                $hash[$row['sifra_predmeta']] = true;
                echo $row['sifra_predmeta']." ".$row['naziv']." ".$row['fond_casova']." ".$row['semestar']."<br/>";
            }
        }
    }
    include('db_disconn.php');
    include('footer.html');
    ?>
    </div>
</doby>