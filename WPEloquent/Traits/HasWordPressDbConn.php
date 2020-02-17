<?php

namespace WPEloquent\Traits;

trait HasWordPressDbConn {
    public static $default_connection;

    public static function setDefaultConnection($connection)
    {
        self::$default_connection = $connection;
    }

    protected function initializeHasWordPressDbConn()
    {
        if (isset(self::$default_connection)) {
            $this->connection = self::$default_connection;
        }
    }
}
