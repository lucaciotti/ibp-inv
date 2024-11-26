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
        Schema::create('inventory_measurements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_session_id');
            $table->unsignedBigInteger('inventory_session_warehouse_id');
            $table->unsignedBigInteger('inventory_ticket_id');
            $table->string('ticket');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('ubic_id');
            $table->double('qty');
            $table->timestamps();

            $table->foreign('inventory_session_id')->references('id')->on('inventory_sessions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('inventory_ticket_id')->references('id')->on('inventory_session_tickets')
                ->onUpdate('cascade')->onDelete('cascade'); 

            $table->foreign('inventory_session_warehouse_id')->references('id')->on('inventory_session_warehouses')
                ->onUpdate('cascade')->onDelete('cascade'); 

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade'); 

            $table->foreign('warehouse_id')->references('id')->on('warehouses')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('ubic_id')->references('id')->on('ubications')
                ->onUpdate('cascade')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_measurements');
    }
};
