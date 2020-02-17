<?php

namespace WPEloquent\Model;

abstract class BaseMeta extends BaseModel {
    protected $fillable = ['meta_key', 'meta_value'];
    protected $primaryKey = 'meta_id';
}