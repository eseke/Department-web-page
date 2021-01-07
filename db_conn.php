<?php
    $conn = mysqli_connect("localhost","root","","department");

    if(mysqli_connect_errno()){
        echo "Greska u konekciji na Mysql".mysqli_connect_error();
        exit();
    }
?>