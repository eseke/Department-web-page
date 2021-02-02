<?php
    if(isset($result))
        mysqli_free_result($result);
    if($conn)
        mysqli_close($conn);
?>