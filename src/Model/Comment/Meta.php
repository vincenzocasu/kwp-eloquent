<?php

namespace WPEloquent\Model\Comment;

use WPEloquent\Model\BaseMeta;

class Meta extends BaseMeta
{
    /** @var string */
    protected $table   = 'commentmeta';

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function comment()
    {
        return $this->belongsTo(\WPEloquent\Model\Comment::class);
    }
}
