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
        Schema::create('info_orders', function (Blueprint $table) {
            $table->id();
            $table->string('billOfLadingNumber');
            $table->string('nameTU');
            $table->date('dayStart');
            $table->string('itemContent');
            $table->integer('trackingNumber');
            $table->float('declaredValue');
            $table->foreignId('transportUnit_id')->constrained('transport_units')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_items');
    }
};
