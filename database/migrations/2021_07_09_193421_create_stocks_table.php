<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->decimal('cost',10,2);
            $table->decimal('price',10,2);
            $table->integer('quantity');
            $table->integer('alert');
            $table->datetime('expiration_date');
            $table->timestamps();

            $table->foreignId('product_id')->constrained();
            $table->foreignId('lot_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
