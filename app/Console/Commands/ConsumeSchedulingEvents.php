<?php

namespace App\Console\Commands;

use App\Models\Visit;
use App\Services\RabbitMQConnection;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:consume-scheduling-events')]
#[Description('Consume scheduling events from RabbitMQ')]
class ConsumeSchedulingEvents extends Command {

    public function __construct(private RabbitMQConnection $connection) {
        parent::__construct();
    }

    public function handle(): void {
        $channel = $this->connection->channel();
        $channel->basic_consume('medical-records.queue', '', callback:function($msg) use ($channel) {
            $data = json_decode($msg->body, true);
            match ($msg->delivery_info['routing_key']) {
                'appointment.deleted' => Visit::where('appointment_id', $data['payload']['appointment_id'])->delete(),
                default => null,
            };
            $channel->basic_ack($msg->delivery_info['delivery_tag']);
        });

        $this->info('Listening for scheduling events...');
        while (true) $channel->wait();
    }
}
