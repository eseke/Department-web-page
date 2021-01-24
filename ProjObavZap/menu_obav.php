<div class='row' >
    <div class='col-sm-12' id = 'menu'>
        <a href = 'obavestenja'>Sva</a>
        <?php
            
        include('db_conn.php');
        $result = mysqli_query($conn,'SELECT * from kategorija_obavestenja');
        while($row = mysqli_fetch_assoc($result)){
            echo "&nbsp;&nbsp;<a href = '?tip=".$row['naziv']."'>".$row['naziv']."</a>";
        }
        ?>
        <hr style = "height:1px;margin:0;color:darkred;background-color:darkred"/>
    </div>
</div>

