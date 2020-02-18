<?php

namespace WPEloquent\Model\Post;

use WPEloquent\Model\BaseMeta;

class Meta extends BaseMeta
{
    /** @var string */
    protected $table   = 'postmeta';

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function post()
    {
        return $this->belongsTo(\WPEloquent\Model\Post::class);
    }
}
