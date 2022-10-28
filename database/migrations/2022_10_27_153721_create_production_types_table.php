<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $incrementing = false;
    protected $primaryKey = 'alias';
    protected $guarded = [];
    public function up()
    {
        if (!Schema::hasTable('production_types')) {
            Schema::create('production_types', function (Blueprint $table) {

                $table->string('alias')->primary();
                $table->string("type")->comment("Тип продукции");
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
        Schema::dropIfExists('production_types');
    }
}
