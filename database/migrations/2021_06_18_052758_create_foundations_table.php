<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoundationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foundations', function (Blueprint $table) {
            $table->id();
        
            $table->integer('prepared')->default(100);
            $table->integer('mutable')->default(100);
            $table->integer('deletable')->default(100);

            $table->string('alias', 128)->nullable()->unique();
            $table->string('ikey')->default('foundations');
            $table->string('logo')->nullable();
            $table->string('index', 128)->nullable()->unique();
            $table->string('slug', 128)->nullable()->unique();
            $table->string('code', 80)->nullable()->unique();
            $table->boolean('valid')->default(true);
            $table->boolean('blocked')->default(false);
            $table->boolean('published')->default(false);
            $table->boolean('chatable')->default(1);

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
        Schema::dropIfExists('foundations');
    }
}
