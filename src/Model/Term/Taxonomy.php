<?php

namespace WPEloquent\Model\Term;

use WPEloquent\Model\BaseModel;

class Taxonomy extends BaseModel
{
    /** @var string */
    protected $table = 'term_taxonomy';

    /** @var array */
    protected $fillable = [
        'term_taxonomy_id', 'term_id', 'taxonomy', 'description', 'parent', 'count'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function term()
    {
        return $this->belongsTo(\WPEloquent\Model\Term::class, 'term_id', 'term_id');
    }
}
