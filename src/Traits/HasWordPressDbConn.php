<?php

namespace WPEloquent\Traits;

trait HasWordPressDbConn
{

    protected static $default_connection;
    protected static $WPE_HWDC_initialized = [];
    public $class_hash;

    public static function setDefaultConnection(string $connection)
    {
        self::$default_connection = $connection;
    }

    protected function initializeHasWordPressDbConn()
    {
        if (isset(self::$default_connection)) {
            $this->connection = self::$default_connection;
            self::$WPE_HWDC_initialized[$this->class_hash] = true;
        }
    }

    protected function traitInitedForClass(): bool
    {
        if (! isset(self::$WPE_HWDC_initialized[$this->class_hash])) {
            self::$WPE_HWDC_initialized[$this->class_hash] = false;
        }
        return self::$WPE_HWDC_initialized[$this->class_hash];
    }
}
