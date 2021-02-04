        <div class='row header' >
            <div class='col-sm-2'>
                <img src='https://www.etf.bg.ac.rs/assets/logo-sr-449e87364798e04e5b9e49e085f8ca26f431ecf6bf7aa458926b23fa1836b640.png' id='header_photo'>
            </div>
            <div class='col-sm-7 reklama'>
                <a href='http://bg.ac.rs' target="_blank" rel="noopener noreferrer" id='link'>Univerzitet u Beogradu</a> <br/>
                <a href='http://etf.bg.ac.rs' target="_blank" rel="noopener noreferrer" id='link'>Elektrotehnicki fakultet</a> <br/>
                Katedra za računarsku tahniku i informatiku
            </div>
            <div class='col-sm-3' id='login'>
                <?php
                    
                    if(isset($_SESSION['name'])){
                        if(($_SESSION['type'] == 'z'))
                            echo "<a href='nastavnik/profil' id='nastavnik'>";
                        else if($_SESSION['type']=='a')
                            echo "<a href='admin/korisnici' id='nastavnik'>";
                        echo $_SESSION['name']." ".$_SESSION['surname']."<br/>";
                        echo $_SESSION['role']."</br>";
                        if(($_SESSION['type'] == 'z')||($_SESSION['type'] == 'a'))
                            echo "</a>";
                        include('logout.html');
                        if(!isset($passpage))
                            echo "<a href = '/password' id='nastavnik'>Promenti lozinku</a>";
                    }else{
                        include('login.html');
                    }
                    if(isset($_SESSION['login_mess']))
                    {
                        echo $_SESSION['login_mess'];
                        unset($_SESSION['login_mess']);
                    }
                ?>
            </div>
        </div>
