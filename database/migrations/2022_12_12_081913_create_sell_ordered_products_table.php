<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_ordered_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedFloat('quantity');
            $table->unsignedTinyInteger('status')->default(0);
            $table->text('notes')->nullable();
            $table->unsignedMediumInteger('product_id');
            $table->foreignId('sell_order_id')->constrained();

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
        Schema::dropIfExists('sell_ordered_products');
    }
};
