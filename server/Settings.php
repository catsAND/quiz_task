<?php

namespace Api;

use Api\Exception\SettingsException;
use Api\Controller\{Ping};

/**
 * Store all settings
 */
class Settings
{
    /**
     * Settings that require doctrine
     *
     * @return array
     */
    protected function getDoctrineSettings() : array
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

    /**
     * Route settings
     *
     * @return array
     */
    protected function getRouteSettings() : array
    {
        return [
            ['GET', '/ping', [Ping::class, 'execute']],
        ];
    }

    /**
     * Magic method calling function that contain settings
     *
     * @param string $name
     * @param array $arguments
     *
     * @return array
     */
    public function __call(string $name, array $arguments) : array
    {
        $methodName = 'get' . ucfirst($arguments[0]) . 'Settings';
        if ($name != 'get' || !method_exists($this, $methodName)) {
            throw new SettingsException($arguments[0]);
        }

        return call_user_func(array($this, $methodName), $arguments);
    }
}
