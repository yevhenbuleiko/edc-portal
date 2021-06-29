<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_info', function (Blueprint $table) {
            
            $table->id('role_info_id');

            $table->string('name')->nullable();
            $table->text('desc')->nullable();

            $table->foreignId('role_id')->nullable()->constrained('roles');
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
        Schema::dropIfExists('roles_info');
    }
}
