<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fee_management', function (Blueprint $table) {
            $table->id();
            $table->string('feeCode');
            $table->string('typeOfCustomer');
            $table->float('minWeight');
            $table->float('maxWeight');
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_management');
    }
};
