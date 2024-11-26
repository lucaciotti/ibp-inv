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
        Schema::create('inventory_session_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_session_warehouse_id');
            $table->string('ticket');
            $table->date('date_printed');
            $table->timestamps();

            $table->foreign('inventory_session_warehouse_id')->references('id')->on('inventory_session_warehouses')
                ->onUpdate('cascade')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_session_tickets');
    }
};
