<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'prod_cats';

    public $incrementing = false;

    public $timestamps = false;
}
