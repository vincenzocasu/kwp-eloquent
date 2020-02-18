<?php

namespace WPEloquent\Model\Term;

use WPEloquent\Model\BaseModel;

class Taxonomy extends BaseModel
{
    protected $table = 'term_taxonomy';

    public function term()
    {
        return $this->belongsTo(\WPEloquent\Model\Term::class, 'term_id', 'term_id');
    }
}
