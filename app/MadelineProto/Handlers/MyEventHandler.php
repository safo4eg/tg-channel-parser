<?php

namespace App\MadelineProto\Handlers;
use danog\MadelineProto\EventHandler\Attributes\Handler;
use danog\MadelineProto\SimpleEventHandler;
use danog\MadelineProto\EventHandler\Message;
use danog\MadelineProto\EventHandler\SimpleFilter\Incoming;
use Illuminate\Support\Facades\Log;

class MyEventHandler extends SimpleEventHandler
{

    #[Handler]
    public function handleMessage(Incoming&Message $message): void
    {
        Log::channel('single')->debug('#Сообщение');
        Log::channel('single')->debug($message);
    }
}