<?php
require_once '../classes/rabbitmq/Producer.php';
require_once __DIR__ . '../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$conn = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
echo "teste";

$rabbimq = new ProducerSQL($conn);
$rabbimq->setMessage('SELECT * FROM user');
$rabbimq->setChannel('log_sql');

$rabbimq->send('log_sql');
