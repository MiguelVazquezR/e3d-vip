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
        Schema::create('sell_orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedFloat('freight_cost')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->text('notes')->nullable();
            $table->string('shipping_company')->nullable();
            $table->string('tracking_guide')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('requirement_date');
            $table->timestamp('received_at')->nullable();

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
        Schema::dropIfExists('sell_orders');
    }
};
