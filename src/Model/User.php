<?php

namespace WPEloquent\Model;

use WPEloquent\Traits\HasMeta;
use WPEloquent\Traits\HasRoles;

class User extends BaseModel
{
    use HasMeta;
    use HasRoles;

    /** @var string */
    protected $table = 'users';

    /** @var string */
    protected $primaryKey = 'ID';

    /** @var string */
    public const CREATED_AT = 'user_registered';


    /** @var array */
    protected $fillable = [
        'ID', 'user_login', 'user_pass', 'user_nicename', 'user_email', 'user_url', 'user_registered',
        'user_activation_key', 'user_status', 'display_name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'post_author')
            ->where('post_status', 'publish')
            ->where('post_type', 'post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function meta()
    {
        return $this->hasMany(User\Meta::class, 'user_id')
            ->select(['user_id', 'meta_key', 'meta_value']);
    }
}
