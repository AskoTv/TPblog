<?php 
    session_start();
    $_SESSION['is_connected']=false;
    session_destroy(); 
    header('Location:../index.php'); 