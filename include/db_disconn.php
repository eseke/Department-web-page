<?php
    if(isset($result))//ukoliko postoji neki rezultat on se brise
        mysqli_free_result($result);
    if($conn) //otkacinjanje sa baze
        mysqli_close($conn);
?>