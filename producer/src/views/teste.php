<?php
use RabbitMQ\Producer;
use PhpAmqpLib\Connection\AMQPStreamConnection;

require_once __DIR__ . '../../../vendor/autoload.php';
$conn = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
echo "teste";

$rabbimq = new Producer($conn);
$rabbimq->setMessage('SELECT * FROM user');
$rabbimq->setChannel('log_sql');

$rabbimq->send('log_sql');
