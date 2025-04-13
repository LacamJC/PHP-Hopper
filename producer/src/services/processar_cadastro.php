<?php
require_once '../classes/validation/ValidateUser.php';
session_start();
require_once '../classes/rdg/UserGateway.php';
try {
    $conn = new PDO('sqlite:../database/database.db');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    UserGateway::setConnection($conn);
    $ug = new UserGateway;
    $user = new ValidateUser($_POST['nome_usuario'], $_POST['email'], $_POST['senha'], $_POST['confirma_senha']);
    $ug->nome = $_POST['nome_usuario'];
    $ug->email = $_POST['email'];
    $ug->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $ug->save();
    header('Location: ../views/login.php');
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
    $_SESSION['errorMessage'] = "Erro ao cadastrar usuário, email já está em uso";
    header('Location:../index.php');
    exit();
    
}
