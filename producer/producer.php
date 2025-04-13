<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// Conexão com o RabbitMQ
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

// Declara a fila
$channel->queue_declare('fila_basica', false, false, false, false);

// Cria a mensagem
$mensagem = new AMQPMessage('Olá, RabbitMQ!');

// Publica a mensagem na fila
$channel->basic_publish($mensagem, '', 'fila_basica');

echo " [x] Mensagem enviada\n";

// Fecha canal e conexão
$channel->close();
$connection->close();
?>