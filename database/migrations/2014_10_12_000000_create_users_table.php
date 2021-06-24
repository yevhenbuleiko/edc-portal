<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->string('ikey')->default('users');
            $table->integer('status')->default(0);

            $table->string('logo')->nullable();
            $table->boolean('show_logo')->default(1);
            $table->boolean('sex')->default();
            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->boolean('blocked')->default(0);
            $table->boolean('valid')->default(1);
            $table->boolean('published')->default(1);
            
            $table->boolean('remote')->default(0);
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
        Schema::dropIfExists('users');
    }
}
