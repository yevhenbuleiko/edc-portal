<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombfoundationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combfoundations', function (Blueprint $table) {
            
            $table->integer('status')->default(0);
            
            $table->foreignId('unif_id')->nullable()->constrained('foundations');
            $table->foreignId('comb_id')->nullable()->constrained('foundations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combfoundations');
    }
}
