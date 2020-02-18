<?php

namespace WPEloquent\Model;

use WPEloquent\Traits\HasWordPressDbConn;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class BaseModel extends EloquentModel
{
    use HasWordPressDbConn;

    /** @var string */
    public $timestamps = false;
}
