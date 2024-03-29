<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->integer("transaction_id");
            $table->integer("product_id");
            $table->string("code");
            $table->string("product");
            $table->integer("quantity");
            $table->string("unit");
            $table->integer("price");
            $table->integer("buy_price");
            $table->integer("discount_item")->nullable();
            $table->integer("sub_total");
            $table->integer("capital");
            $table->integer("profit");
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
        Schema::dropIfExists('transaction_details');
    }
}
