<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->id();
            $table->string("datetime");
            $table->integer("product_id");
            $table->integer("quantity");
            $table->string("note")->nullable();
            $table->integer("created_by");
            $table->integer("updated_by")->nullable();
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
        Schema::dropIfExists('stock_outs');
    }
}
