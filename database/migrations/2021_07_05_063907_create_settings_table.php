<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->string('by')->nullable();
            $table->string('value')->nullable();

            $table->bigInteger('settingable_id')->nullable();
            $table->string('settingable_type')->nullable();

            $table->foreignId('foundation_id')->nullable()->constrained('foundations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
