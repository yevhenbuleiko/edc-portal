<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();

            $table->string('alias')->nullable()->default('view_page');
            $table->string('ikey')->default('roles');
            $table->boolean('blocked')->default(0);
            $table->boolean('valid')->default(1);
            $table->boolean('published')->default(1);

            $table->string('for')->nullable();
            $table->integer('for_number')->nullable();
            $table->integer('number')->nullable();

            $table->integer('status')->default(0);

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
        Schema::dropIfExists('permissions');
    }
}
