<?php
session_start();

use Database\Gateway\UserGateway;

try {

    unset($_SESSION['id']);
    session_destroy(); 
    header('Location:../views/login.php');
    exit();
} catch (Exception $e) {
    echo $e->getMessage();
}
