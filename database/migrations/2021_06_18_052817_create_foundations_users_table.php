<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoundationsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foundations_users', function (Blueprint $table) {

            $table->boolean('pv_blocked')->default(0);
            $table->boolean('pv_valid')->default(1);
            $table->boolean('pv_published')->default(1);
            $table->boolean('pv_remote')->default(0);

            $table->timestamp('pv_deleted_at')->nullable();
            $table->timestamp('pv_binded_at')->nullable();
            $table->timestamp('pv_updated_at')->nullable();

            // json string like '{"{<str_key>":{"act":[ids...],"lead":[ids...],"exc":[ids]}}'
            // act: active ids, lead: parent ids, exc: exclude ids
            // Data Is Collected From A Table: users_roles From Field - pv_context
            $table->text('pv_context')->nullable(); 

            $table->foreignId('foundation_id')->nullable()->constrained('foundations');
            $table->foreignId('user_id')->nullable()->constrained('users');

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
        Schema::dropIfExists('foundations_users');
    }
}
