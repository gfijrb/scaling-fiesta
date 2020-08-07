<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCatsTable extends Migration
{

    protected $table = 'cats';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->timestamps();
        });

        $list = [
            ['name' => 'Baby'],
            ['name' => 'Beauty'],
            ['name' => 'Books'],
            ['name' => 'Camera & Photo'],
            ['name' => 'Clothing & Accessories'],
            ['name' => 'Electronics'],
            ['name' => 'Grocery & Gourmet Foods'],
            ['name' => 'Health & Personal Care'],
            ['name' => 'Home & Garden'],
            ['name' => 'Office Products'],
            ['name' => 'Kindle Accessories'],
            ['name' => 'Luggage & Travel Accessories'],
            ['name' => 'Pet Supplies'],
            ['name' => 'Shoes, Handbags, & Sunglasses'],
            ['name' => 'Personal Computers'],
            ['name' => 'Software'],
            ['name' => 'Sports'],
            ['name' => 'Tools & Home Improvement'],
            ['name' => 'Toys'],
            ['name' => 'Video Games'],
        ];

        DB::table($this->table)
            ->insert($list);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
