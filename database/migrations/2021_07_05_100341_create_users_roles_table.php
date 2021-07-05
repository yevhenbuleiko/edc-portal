<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_roles', function (Blueprint $table) {
            
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('role_id')->nullable()->constrained('roles');

            $table->boolean('pv_blocked')->default(0);
            $table->boolean('pv_valid')->default(1);
            $table->boolean('pv_published')->default(1);
            $table->boolean('pv_temp')->default(0);
            $table->text('pv_context')->nullable();

            $table->timestamp('pv_from_date')->nullable();
            $table->timestamp('pv_to_date')->nullable();

            $table->timestamp('pv_binded_at')->nullable();
            $table->timestamp('pv_updated_at')->nullable();

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
        Schema::dropIfExists('users_roles');
    }
}
