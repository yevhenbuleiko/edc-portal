<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatroomsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatrooms_info', function (Blueprint $table) {
            $table->id('chatroom_info_id');

            $table->string('name')->nullable();
            $table->text('desc')->nullable();

            $table->foreignId('chatroom_id')->nullable()->constrained('chatrooms');
            $table->string('langkey', 10)->nullable();
            $table->foreign('langkey')->references('lang')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chatrooms_info');
    }
}
