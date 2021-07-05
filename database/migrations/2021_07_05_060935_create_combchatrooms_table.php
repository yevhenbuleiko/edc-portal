<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombchatroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combchatrooms', function (Blueprint $table) {
            
            $table->integer('status')->default(0);
            $table->foreignId('foundation_id')->nullable()->constrained('foundations');
            
            $table->foreignId('unif_id')->nullable()->constrained('chatrooms');
            $table->foreignId('comb_id')->nullable()->constrained('chatrooms');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combchatrooms');
    }
}
