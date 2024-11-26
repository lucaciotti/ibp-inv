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
        Schema::create('inventory_session_warehouses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_session_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedInteger('ticket_printed')->default(0);
            $table->timestamps();

            $table->foreign('inventory_session_id')->references('id')->on('inventory_sessions')
                ->onUpdate('cascade')->onDelete('cascade'); 

            $table->foreign('warehouse_id')->references('id')->on('warehouses')
                ->onUpdate('cascade')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_session_warehouses');
    }
};
