<?php
    session_start();

    if(isset($_SESSION['poruka']))
    {
        echo $_SESSION['poruka'];
        unset($_SESSION['poruka']);
    }

    include('login.php');
    
    if(isset($_SESSION['name'])){
        echo "Pozdrav ".$_SESSION['name']."!";
        include('logout.html');
    }else{
        include('login.html');
    }

    
?>