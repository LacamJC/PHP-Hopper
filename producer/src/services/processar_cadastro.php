<?php
require_once '../classes/validation/ValidateUser.php';
session_start();
require_once '../classes/rdg/UserGateway.php';
require_once '../classes/rabbitmq/Producer.php';
require_once __DIR__ . '../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

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
    $rmq = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $rabbimq = new Producer($rmq);
    $rabbimq->setMessage($ug->email);
    $rabbimq->setChannel('log_sql');
    $rabbimq->send('log_sql');
    header('Location:../views/login.php');
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
    $_SESSION['errorMessage'] = "Erro ao cadastrar usuário, email já está em uso";
    header('Location:../views/index.php');
    exit();
}
