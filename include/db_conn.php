<?php
    $conn = mysqli_connect("localhost","root","","department");//konektovanje na bazu
    mysqli_set_charset($conn,"utf8");//Tip karatera. Zbog č,ć,š,đ,ž
    
    if(mysqli_connect_errno()){//Prijava greske pri konektovanju na bazu
        echo "Greska u konekciji na Mysql".mysqli_connect_error();
        exit();
    }
?>