<?php

use App\Models\Quotation;
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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('seller_id')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamp('released_at')->nullable();
            $table->unsignedTinyInteger('status')->default(Quotation::STATUS_IN_CHECKING);
            $table->unsignedFloat('freight_cost')->nullable();
            $table->unsignedFloat('tooling_cost')->nullable();
            $table->string('currency', 5)->nullable();

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
        Schema::dropIfExists('quotations');
    }
};
