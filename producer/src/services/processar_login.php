<?php
session_start();

use Database\Gateway\UserGateway;

try {
    $conn = new PDO('sqlite:../database/database.db');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    UserGateway::setConnection($conn);
    $user = new stdClass;
    $user->email = $_POST['email'];
    $user->senha = $_POST['senha'];

    $find = UserGateway::findByEmail($user->email);
    if ($find && password_verify($user->senha, $find->senha)) {

        $_SESSION['id'] = $find->id;
        echo "Logado com sucesso";
        header('Location: ../views/perfil.php');
    } else {
        $_SESSION['errorMessage'] = "Usuário não encontrado";
        throw new Exception('Usuario não encontrado');
    }
} catch (Exception $e) {
    header('Location:../views/login.php');
}
