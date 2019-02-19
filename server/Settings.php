<?php

namespace Api;

use Api\Exception\SettingsException;

class Settings
{
    protected function getDoctrineSettings()
    {
        return [
            'dev_mode' => true,
            // 'cache_dir' => APP_ROOT . '/cache/doctrine',
            'metadata_dirs' => [APP_ROOT . '/Entity'],
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'admin',
                'user' => 'admin',
                'password' => 'admin',
            ]
        ];
    }

    public function __call($name, $arguments)
    {
        $methodName = 'get' . ucfirst($arguments[0]) . 'Settings';
        if ($name != 'get' || !method_exists($this, $methodName)) {
            throw new SettingsException($arguments[0]);
        }

        return call_user_func(array($this, $methodName), $arguments);
    }
}
