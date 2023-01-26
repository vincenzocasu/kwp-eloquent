<?php

namespace WPEloquent\Model\Term;

use WPEloquent\Model\BaseModel;

class Relationships extends BaseModel
{
    /** @var string */
    protected $table = 'term_relationships';
    
    /** @var string */
    protected $primaryKey = 'term_taxonomy_id';

    /** @var array */
    protected $fillable = [
        'object_id', 'term_taxonomy_id', 'term_order'
    ];
}
