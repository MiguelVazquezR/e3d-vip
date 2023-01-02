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
        Schema::create('product_quotations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('quotation_id')->constrained()->onDelete('cascade');
            $table->unsignedMediumInteger('product_id');
            $table->unsignedFloat('quantity');
            $table->unsignedFloat('price')->nullable();
            $table->boolean('is_composed_product')->default(1);
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('product_quotations');
    }
};
