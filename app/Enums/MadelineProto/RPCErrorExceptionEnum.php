<?php

namespace App\Enums\MadelineProto;

enum RPCErrorExceptionEnum
{
    case PHONE_CODE_INVALID;

    public function getCaseDescription(string $name): string
    {
        $descriptions = [
            self::PHONE_CODE_INVALID->name => 'Неверный код подтверждения.'
        ];

        return $descriptions[$name];
    }
}
