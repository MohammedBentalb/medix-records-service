<?php

namespace App\Console\Commands;

use App\Actions\SendHeartbeatAction;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:send-heartbeat')]
#[Description('Command description')]
class SendHeartbeat extends Command {
    public function __construct(private SendHeartbeatAction $sendHeartbeatAction) {
        parent::__construct();
    }
    public function handle() {
        $this->sendHeartbeatAction->execute();
    }
}
