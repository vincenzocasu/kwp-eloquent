<?php

namespace WPEloquent\Core;

use Config;
use Illuminate\Database\Capsule\Manager;

/**
 * WP Eloquent Laravel Shim Class
 *
 * Used to setup and boot Eloquent when outside of Laravel.
 */
class Laravel
{

    /**
     * @var \Illuminate\Database\Capsule\Manager
     */
    // phpcs:ignore
    protected static $_capsule;

    /**
     * Create and connect Laravel DB Manager outside Laravel.
     *
     * @param array $options
     * @return Manager
     */
    public static function connect($options = []): Manager
    {

        $defaults = [
            'global' => true,

            'config' => [
                'database' => [
                    'user'     => '',
                    'password' => '',
                    'name'     => '',
                    'host'     => '',
                    'port'     => '3306'
                ],

                'prefix' => 'wp_'
            ],

            'events' => false,

            'log'    => true
        ];

        $options = array_replace_recursive($defaults, $options);

        if (is_null(self::$_capsule)) {
            self::$_capsule = new Manager();

            self::$_capsule->addConnection([
                'driver'    => 'mysql',
                'host'      => $options['config']['database']['host'],
                'database'  => $options['config']['database']['name'],
                'username'  => $options['config']['database']['user'],
                'password'  => $options['config']['database']['password'],
                'port'      => $options['config']['database']['port'],
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => $options['config']['prefix']
            ]);

            self::$_capsule->bootEloquent();

            if ($options['events']) {
                self::$_capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher());
            }

            if ($options['global']) {
                self::$_capsule->setAsGlobal();
            }

            if ($options['log']) {
                self::$_capsule->getConnection()->enableQueryLog();
            }
        }

        return self::$_capsule;
    }

    /**
     * @return \Illuminate\Database\Connection
     */
    public static function getConnection()
    {
        return self::$_capsule->getConnection();
    }

    /**
     * @return array
     */
    public static function queryLog()
    {
        return self::getConnection()->getQueryLog();
    }
}
