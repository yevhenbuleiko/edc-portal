<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            
            $table->string('code', 10)->nullable();
            $table->string('country')->nullable();
            $table->string('title')->nullable();
            $table->string('html_code')->nullable();
            $table->string('img')->nullable();
            $table->string('ikey')->default('currencies');

            $table->integer('prepared')->default(100);
            $table->integer('mutable')->default(0);
            $table->integer('deletable')->default(0);

            $table->boolean('blocked')->default(0);
            $table->boolean('valid')->default(1);
            $table->boolean('published')->default(1);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
