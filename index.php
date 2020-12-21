<?php
    session_start();
    if(isset($_POST['odjava'])){
        unset($_SESSION['username']);
        unset($_SESSION['pass']);
        header("Location: #");
    }elseif(isset($_POST['username'])){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['pass'] = $_POST['pass'];
        header("Location: #");
    }elseif(!isset($_SESSION['username'])){
        include("login.html");
    }elseif($_SESSION['username']=='admin'){
        echo "admin";
    }elseif($_SESSION['username']=='prof'){
        echo "prof";
    }elseif($_SESSION['username']=='stud'){
        echo "stud";
    }
    if(isset($_SESSION['username'])){
        include('logout.html');
    }
?>