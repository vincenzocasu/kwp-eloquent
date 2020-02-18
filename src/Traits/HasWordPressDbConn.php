<?php

namespace WPEloquent\Traits;

trait HasWordPressDbConn
{

    /** @var string */
    public $class_hash;

    /** @var string */
    protected static $default_connection;

    /**
     * @var array<string, bool>
     */
    protected static $WPE_HWDC_initialized = [];

    /**
     * Allows setting a default connection on the model.
     *
     * @param string $connection
     * @return void
     */
    public static function setDefaultConnection(string $connection)
    {
        self::$default_connection = $connection;
    }

    /**
     * Initializes this trait and tracks which class just inited.
     *
     * @return void
     */
    protected function initializeHasWordPressDbConn()
    {
        if (isset(self::$default_connection)) {
            $this->connection = self::$default_connection;
            self::$WPE_HWDC_initialized[$this->class_hash] = true;
        }
    }

    /**
     * Determines which classes this trait is initilized with.
     *
     * @return boolean
     */
    protected function traitInitedForClass(): bool
    {
        if (! isset(self::$WPE_HWDC_initialized[$this->class_hash])) {
            self::$WPE_HWDC_initialized[$this->class_hash] = false;
        }
        return self::$WPE_HWDC_initialized[$this->class_hash];
    }
}
