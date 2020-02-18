<?php

namespace WPEloquent\Model\Term;

use WPEloquent\Model\BaseModel;

class Relationships extends BaseModel {
    protected $table = 'term_relationships';
    protected $primaryKey = 'term_taxonomy_id';
}
