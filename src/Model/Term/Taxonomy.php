<?php

namespace WPEloquent\Model\Term;

use WPEloquent\Model\BaseModel;

class Taxonomy extends BaseModel
{
    /** @var string */
    protected $table = 'term_taxonomy';

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function term()
    {
        return $this->belongsTo(\WPEloquent\Model\Term::class, 'term_id', 'term_id');
    }
}
