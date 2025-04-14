<?php

require_once __DIR__ . '../../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Producer
{

    private $connection;
    private $channel;
    private $message;

    public function __construct(AMQPStreamConnection  $conn)
    {
        try {
            $this->connection = $conn;
            return true;
        } catch (Exception $e) {
            echo "Erro ao iniciar conexão com RabbitMQ: {$e->getMessage()}";
            return false;
        }
    }

    public function setMessage($msg)
    {
        try {
            $this->message = new AMQPMessage($msg);
            return true;
        } catch (Exception $e) {
            echo "Erro ao adicionar mensage: {$e->getMessage()}";
            return false;
        }
    }

    public function setChannel($name)
    {
        try {
            $this->channel = $this->connection->channel();
            $this->channel->queue_declare("$name", false, false, false, false);
            return true;
        } catch (Exception $e) {
            echo "Erro ao adicionar ao canal: ";
            echo $e->getMessage(); 
            return false;
        }
    }

    public function send($queue)
    {
        try {
            $this->channel->basic_publish($this->message, '', "$queue");
            $this->channel->close();
            $this->connection->close();
            return true;
        } catch (Exception $e) {
            echo "Erro ao enviar mensage: {$e->getMessage()}";
            return false;
        }
    }
}
