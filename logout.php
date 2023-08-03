<?php

    session_start();
    if(isset($_SESSION['sportify_userid']))
    {
        $_SESSION['sportify_userid']=NULL;
        unset($_SESSION['sportify_userid']);
    }
    header("Location: login.php");
    die;

?>