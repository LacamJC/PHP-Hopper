<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

define('RABBITMQ_HOST', 'localhost');
define('RABBITMQ_PORT', 5672);
define('RABBITMQ_USER', 'guest');
define('RABBITMQ_PASS', 'guest');
define('RABBITMQ_VHOST', '/');

// Função para criar conexão
function createRabbitMQConnection() {
    return new AMQPStreamConnection(
        RABBITMQ_HOST,
        RABBITMQ_PORT,
        RABBITMQ_USER,
        RABBITMQ_PASS,
        RABBITMQ_VHOST
    );
}