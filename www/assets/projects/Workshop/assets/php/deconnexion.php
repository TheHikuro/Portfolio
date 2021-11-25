<?php

    session_unset();
    session_destroy();
    $URL="/assets/projects/index.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        