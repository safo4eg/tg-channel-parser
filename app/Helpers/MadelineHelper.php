<?php

namespace App\Helpers;

use danog\MadelineProto\API;
use danog\MadelineProto\Settings;
use \danog\MadelineProto\Settings\Database\Mysql;
use danog\MadelineProto\Settings\AppInfo;
use Illuminate\Support\Facades\Storage;

class MadelineHelper
{
    const CONFIG_NAME = 'madeline';

    public static function getMadelineProtoInstance(string $phoneNumber): API
    {
        $appInfo = self::getAppInfo();
        $settings = (new Settings())
            ->setAppInfo($appInfo);

        $sessionDirectory = self::getLocalConfig('sessions_directory');
        $sessionDirectoryPath = storage_path("app/$sessionDirectory");
        if(!is_dir($sessionDirectoryPath)) {
            Storage::makeDirectory($sessionDirectory);
        }

        $madelineProto = new API($sessionDirectoryPath."/$phoneNumber", $settings);

        return $madelineProto;
    }

//    private static function getDatabaseSettings(): Mysql
//    {
//        $config = self::getLocalConfig('database');
//
//        return (new Mysql())
//            ->setUri('tcp://' . $config['host'] . ':' . $config['port'])
//            ->setDatabase($config['database'])
//            ->setUsername($config['username'])
//            ->setPassword($config['password']);
//    }

    private static function getAppInfo(): AppInfo
    {
        $config = self::getLocalConfig('api');

        return (new AppInfo())
            ->setApiId($config['id'])
            ->setApiHash($config['hash']);
    }

    private static function getLocalConfig(string $settingsKey)
    {
        return config(self::CONFIG_NAME.".{$settingsKey}");
    }
}