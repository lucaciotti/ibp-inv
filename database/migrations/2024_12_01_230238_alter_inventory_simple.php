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
        Schema::table('inventory_simples', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('ubic_id');

            // $table->foreign('warehouse_id')->references('id')->on('warehouses')
            //     ->onUpdate('cascade')->onDelete('cascade');

            // $table->foreign('ubic_id')->references('id')->on('ubications')
            //     ->onUpdate('cascade')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_simples', function (Blueprint $table) {
            // $table->dropForeign(['warehouse_id', 'ubic_id']);
            $table->dropColumn('warehouse_id');
            $table->dropColumn('ubic_id');
        });
    }
};
