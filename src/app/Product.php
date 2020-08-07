<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'prods';

    public function genres()
    {
        return $this->hasManyThrough(
            Category::class,
            ProductCategory::class,
            'prods_id',
            'id',
            'id',
            'cats_id'
        );
    }

}
