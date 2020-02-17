<?php

namespace WPEloquent\Model\User;

use WPEloquent\Model\BaseMeta;

class Meta extends BaseMeta {
    protected $table   = 'usermeta';
    protected $primaryKey = 'umeta_id';

    public function user () {
        return $this->belongsTo(\WPEloquent\Model\User::class);
    }
}
