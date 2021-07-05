<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatrooms', function (Blueprint $table) {
            
            $table->id();
            $table->string('alias')->nullable()->default('guest');
            $table->string('ikey')->default('chatrooms');
            $table->boolean('blocked')->default(0);
            $table->boolean('valid')->default(1);
            $table->boolean('published')->default(1);
            $table->boolean('temp')->default(0);
            $table->boolean('chatable')->default(1);
            $table->boolean('personal')->default(0);

            $table->timestamp('from_date')->nullable();
            $table->timestamp('to_date')->nullable();

            $table->integer('status')->default(0);

            $table->bigInteger('chatroomable_id')->nullable();
            $table->string('chatroomable_type')->nullable();

            $table->foreignId('foundation_id')->nullable()->constrained('foundations');
            $table->foreignId('created_id')->nullable()->constrained('users');
            $table->foreignId('modified_id')->nullable()->constrained('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chatrooms');
    }
}
