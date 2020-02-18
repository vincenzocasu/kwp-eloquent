<?php

namespace WPEloquent\Model;

abstract class BaseMeta extends BaseModel
{
    /** @var string */
    protected $primaryKey = 'meta_id';

    /** @var string */
    protected $fillable = ['meta_key', 'meta_value'];
}
