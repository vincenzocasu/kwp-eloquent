<?php

namespace WPEloquent\Model\Term;

use WPEloquent\Model\BaseMeta;

class Meta extends BaseMeta
{
    /** @var string */
    protected $table = 'termmeta';

    /** @var array */
    protected $fillable = [
        'meta_id', 'term_id', 'meta_key', 'meta_value'
    ];
}
