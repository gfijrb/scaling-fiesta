<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('prod_cats', function (Blueprint $table) {
            $table->unsignedBigInteger('cats_id');
            $table->unsignedBigInteger('prods_id');

            $table->foreign('cats_id')
                ->references('id')
                ->on('cats')
                ->onDelete('cascade');

            $table->foreign('prods_id')
                ->references('id')
                ->on('prods')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod_cats');
    }
}
