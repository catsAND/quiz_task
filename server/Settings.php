<?php

namespace Api;

use Api\Exception\SettingsException;
use Api\Controller\{Ping, Quiz};

/**
 * Store all settings
 */
class Settings
{
    /**
     * Base settings
     *
     * @return array
     */
    protected function getBaseSettings() : array
    {
        return [
            'default_language' => 'en',
        ];
    }

    /**
     * Settings that require doctrine
     *
     * @return array
     */
    protected function getDoctrineSettings() : array
    {
        return [
            'dev_mode' => true,
            'proxy_dir' => APP_ROOT . '/Proxy',
            'cache_dir' => APP_ROOT . '/cache/doctrine',
            'metadata_dirs' => [APP_ROOT . '/Entity'],
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'admin',
                'user' => 'admin',
                'password' => 'admin',
                'charset' => 'utf8',
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
            ['GET', '/quiz/list', [Quiz::class, 'getList']],
            ['GET', '/quiz/{id}/list', [Quiz::class, 'getQuestionsAndAnswers']],
            ['GET', '/quiz/result/{uid}', [Quiz::class, 'getResult']],
            ['POST', '/quiz/start', [Quiz::class, 'start']],
            ['POST', '/quiz/answer', [Quiz::class, 'saveAnswer']],
        ];
    }

    /**
     * Magic method calling function that contain settings
     *
     * @param string $name      get
     * @param array  $arguments config name
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
