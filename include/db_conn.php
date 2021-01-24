<?php
    $conn = mysqli_connect("localhost","root","","department");
    mysqli_set_charset($conn,"utf8");
    
    if(mysqli_connect_errno()){
        echo "Greska u konekciji na Mysql".mysqli_connect_error();
        exit();
    }
?>