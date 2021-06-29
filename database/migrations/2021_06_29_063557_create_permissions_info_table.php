<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_info', function (Blueprint $table) {
            $table->id('perm_info_id');

            $table->string('name')->nullable();
            $table->text('desc')->nullable();

            $table->foreignId('permission_id')->nullable()->constrained('permissions');
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
        Schema::dropIfExists('permissions_info');
    }
}
