        <!--
            HEader na vecini osnovnih stranica
        -->
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
                       
                        echo $_SESSION['name']." ".$_SESSION['surname']."<br/>";//Ispis osnovnih informacija o ulogovanom korisniku
                        echo $_SESSION['role']."</br>";//Ispis osnovnih informacija o ulogovanom korisniku
                        if(($_SESSION['type'] == 'z'))//Dodavaje putanje ka nastavnickom meniju
                        echo "<a href='nastavnik/profil' id='nastavnik'>Nastavnički meni";
                    else if($_SESSION['type']=='a')//Dodavanje putanje ka administratorskom meniju
                        echo "<a href='admin/korisnici' id='nastavnik'>Administratorski meni";
                        if(($_SESSION['type'] == 'z')||($_SESSION['type'] == 'a'))
                            echo "</a>";
                        include('logout.html');//logout dugme
                        if(!isset($passpage))
                            echo "<a href = '/password' id='nastavnik'>Promenti lozinku</a>";
                    }else{
                        include('login.html');
                    }
                    if(isset($_SESSION['login_mess']))//Ispis ako je doslo do neke greske
                    {
                        echo $_SESSION['login_mess'];
                        unset($_SESSION['login_mess']);
                    }
                ?>
            </div>
        </div>
