<?php

namespace App\Console\Commands\Parser;

use App\Helpers\MadelineHelper;
use App\MadelineProto\Handlers\MyEventHandler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StartParserCommand extends Command
{
    protected $signature = 'madeline:parser:start {phone}';
    protected $description = 'Запуск парсера';

    public function handle()
    {
        $phoneNumber = $this->argument('phone');

        $madelineProto = MadelineHelper::getMadelineProtoInstance($phoneNumber);
        $result = MyEventHandler::startAndLoop();
        Log::channel('single')->debug('#Обработчик');
        Log::channel('single')->debug($result);
    }
}
