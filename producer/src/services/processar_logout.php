<?php

session_start();
require_once '../classes/rdg/UserGateway.php';
try {

    unset($_SESSION['id']);
    session_destroy(); 
    header('Location:../views/login.php');
    exit();
} catch (Exception $e) {
    echo $e->getMessage();
}
