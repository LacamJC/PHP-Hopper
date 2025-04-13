<?php
session_start();

require_once '../classes/rdg/UserGateway.php';
try {
    $conn = new PDO('sqlite:../database/database.db');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    UserGateway::setConnection($conn);
    $user = UserGateway::find($_SESSION['id']);

    // print_r($user);
    $user->nome = $_POST['nome_usuario'];
    $user->email = $_POST['email'];
    
    $_SESSION['message'] = "Usuário alterado com sucesso";

    $user->save();

    header('Location: ../views/perfil.php');
    exit();
    // echo "<br>";


    // print_r($user);
} catch (Exception $e) {
    echo $e->getMessage();
}
