<?php

namespace WPEloquent\Model;

use WPEloquent\Traits\HasWordPressDbConn;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class BaseModel extends EloquentModel
{
    use HasWordPressDbConn;

    /** @var string */
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->class_hash = md5(get_class($this));

        if (! $this->traitInitedForClass($this->class_hash)) {
            $this->initializeHasWordPressDbConn();
        }

        parent::__construct($attributes);
    }
}
