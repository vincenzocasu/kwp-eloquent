<?php

namespace WPEloquent\Model;

class Attachment extends Post
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_parent', 'ID');
    }
}
