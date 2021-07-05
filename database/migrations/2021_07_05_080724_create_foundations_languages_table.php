<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoundationsLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foundations_languages', function (Blueprint $table) {
            
            $table->foreignId('foundation_id')->nullable()->constrained('foundations');
            $table->string('langkey', 10)->nullable();
            $table->foreign('langkey')->references('lang')->on('languages');

            $table->boolean('native')->default(0);
            $table->boolean('prepare')->default(0);
            $table->timestamp('added_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreignId('pv_created_id')->nullable()->constrained('users');
            $table->foreignId('pv_modified_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foundations_languages');
    }
}
