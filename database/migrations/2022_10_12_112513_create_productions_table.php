<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('productions')){
            Schema::create('productions', function (Blueprint $table) {
                $table->id();

                $table->string('header');
                $table->text('description');
                $table->string('img_path')->nullable();
                $table->timestamps();

                $table->string('production_type_id')->nullable();
                $table->foreign('production_type_id', 'production_type_fk')->references('alias')->on('production_types');
                //$table->index('production_type_id', 'production_type_idx');

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
        Schema::dropIfExists('productions');
    }
}
