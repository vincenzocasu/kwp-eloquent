<?php

namespace WPEloquent\Model\Post;

use WPEloquent\Model\BaseMeta;

class Meta extends BaseMeta
{
    protected $table   = 'postmeta';

    public function post()
    {
        return $this->belongsTo(\WPEloquent\Model\Post::class);
    }
}
