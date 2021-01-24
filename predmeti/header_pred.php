<div class='row header' >
            <div class='col-sm-2'>
                <img src='https://www.etf.bg.ac.rs/assets/logo-sr-449e87364798e04e5b9e49e085f8ca26f431ecf6bf7aa458926b23fa1836b640.png' id='header_photo'>
            </div>
            <div class='col-sm-7 reklama'>
                <a href='/' id='link'>Katedra za računarsku tehniku i informatiku</a><br/>
                <?php echo mysqli_fetch_assoc($result)['naziv']; ?>

            </div>
            <div class='col-sm-3' id='login'>
                <?php
                    
                    if(isset($_SESSION['name'])){
                        echo $_SESSION['name']." ".$_SESSION['surname']."<br/>";
                        echo $_SESSION['role'];
                        include('./include/logout.html');
                    }else{
                        include('./include/login.html');
                    }
                    if(isset($_SESSION['login_mess']))
                    {
                        echo $_SESSION['login_mess'];
                        unset($_SESSION['login_mess']);
                    }
                ?>
            </div>
        </div>
