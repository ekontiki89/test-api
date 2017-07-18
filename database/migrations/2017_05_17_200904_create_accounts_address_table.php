<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('accounts_address', function(Blueprint $table){
            $table->increments('id');
            $table->morphs('address');
            $table->string('street')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('zip_code',5)->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
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
        //
        Schema::dropIfExists('accounts_address');
    }
}
