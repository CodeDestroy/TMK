<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sub_categories')) {
            Schema::create('sub_categories', function (Blueprint $table) {
                $table->id();
                $table->string('alias');
                $table->string('name');
                $table->text('text');
                $table->unsignedBigInteger('parent_id')->nullable();

                $table->foreign('parent_id', 'parent_id_fk')->references('id')->on('categories_table');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
