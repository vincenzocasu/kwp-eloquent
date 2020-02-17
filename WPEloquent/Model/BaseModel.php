<?php

namespace WPEloquent\Model;

use \Illuminate\Database\Eloquent\Model as EloquentModel;

class BaseModel extends EloquentModel {
    public $timestamps = false;
}
