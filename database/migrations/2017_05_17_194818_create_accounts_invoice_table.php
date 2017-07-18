<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('accounts_invoice', function(Blueprint $table){
            $table->increments('id');
            $table->integer('account_id')->unsigned()->nullable();
            $table->string('business_name')->nullable();
            $table->string('rfc')->nullable();
            $table->integer('regime_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('regime_id')->references('id')->on('catalog_tax_regime');

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
        Schema::dropIfExists('accounts_invoice');
    }
}
