<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    public $incrementing = false;
    protected $primaryKey = 'lang';
    public $keyType = 'string';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            
            $table->string('lang', 10)->primary();
            $table->string('title')->nullable();
            $table->string('img')->nullable();
            $table->string('ikey')->default('languages');

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
        Schema::dropIfExists('languages');
    }
}
