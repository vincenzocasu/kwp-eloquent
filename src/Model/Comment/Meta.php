<?php

namespace WPEloquent\Model\Comment;

use WPEloquent\Model\BaseMeta;

class Meta extends BaseMeta
{
    protected $table   = 'commentmeta';

    public function comment()
    {
        return $this->belongsTo(\WPEloquent\Model\Comment::class);
    }
}
