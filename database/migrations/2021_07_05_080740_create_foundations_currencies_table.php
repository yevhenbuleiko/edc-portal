<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoundationsCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foundations_currencies', function (Blueprint $table) {
            
            $table->foreignId('foundation_id')->nullable()->constrained('foundations');
            $table->foreignId('currency_id')->nullable()->constrained('currencies');

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
        Schema::dropIfExists('foundations_currencies');
    }
}
