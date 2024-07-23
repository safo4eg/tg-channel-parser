<?php

namespace App\Console\Commands\Sessions;

use App\Helpers\MadelineHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddSessionCommand extends Command
{
    protected $signature = 'madeline:sessions:add {phone}';

    protected $description = 'Добавление новой сессии (юзербора) в систему.';

    public function handle()
    {
        $phoneNumber = $this->argument('phone');

        $madelineProto = MadelineHelper::getMadelineProtoInstance($phoneNumber);

        try {
            $madelineProto->phoneLogin($phoneNumber);
            $authorization = $madelineProto->completePhoneLogin(
                code: $this->ask('Введите код подтверждения телеграм')
            );

            if($authorization['_'] === 'account.password') {
                $authorization = $madelineProto->complete2faLogin(
                    password: $this->secret('Введите облачный пароль от аккаунта телеграм')
                );
            }

            if($authorization['_'] === 'account.needSignup') {
                $this->info('Для завершения регистрации требуется дополнительная информация');
                $authorization = $madelineProto->completeSignup(
                    first_name: $this->ask('Введите Ваше имя'),
                    last_name: $this->ask('Введите Вашу фамилию')
                );
            }

            if($authorization['_'] === 'auth.authorization') {
                $this->info('');
            }

            Log::channel('single')->debug($authorization);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
