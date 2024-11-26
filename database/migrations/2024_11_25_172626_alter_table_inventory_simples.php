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
            $table->unsignedBigInteger('inventory_session_id');

            // $table->foreign('inventory_session_id')->references('id')->on('inventory_sessions')
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
            $table->dropColumn('inventory_session_id');
        });
    }
};
