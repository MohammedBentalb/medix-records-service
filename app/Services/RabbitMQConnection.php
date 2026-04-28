<?php

namespace App\Services;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use RuntimeException;
use Throwable;

class RabbitMQConnection {
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;

    public function __construct() {
        try {
            $this->connection = new AMQPStreamConnection(
                env('RABBITMQ_HOST', 'localhost'),
                env('RABBITMQ_PORT', 5672),
                env('RABBITMQ_USER', 'guest'),
                env('RABBITMQ_PASSWORD', 'guest'),
                env('RABBITMQ_VHOST', '/'),
            );
            $this->channel = $this->connection->channel();
            $this->channel->exchange_declare('scheduling.events', 'topic', false, true, false);
            $this->channel->queue_declare('medical-records.queue', false, true, false, false);
            $this->channel->queue_bind('medical-records.queue', 'scheduling.events', 'appointment.deleted');
        } catch(Throwable $th) {
            throw new RuntimeException('failed connnecting to RabbitMQ', 0, $th);
        }
    }

    public function channel(){
        return $this->channel;
    }
}
