<?php

$res = mysqli_query($conn,"select * from obavestenje_predmet where id_predmeta='".$_GET['sifra']."'");
echo "obaveštenja";

?>