<?php

namespace WPEloquent\Model\User;

use WPEloquent\Model\BaseMeta;

class Meta extends BaseMeta
{
    /** @var string */
    protected $table   = 'usermeta';
    
    /** @var string */
    protected $primaryKey = 'umeta_id';

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function user()
    {
        return $this->belongsTo(\WPEloquent\Model\User::class);
    }
}
