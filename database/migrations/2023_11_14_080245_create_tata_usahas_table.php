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
        Schema::create('tata_usaha', function (Blueprint $table) {
            $table->integer('id_tata_usaha', true)->nullable(false);
            $table->integer('id_user', false)->index('id_user');

            $table->foreign('id_user')->on('tbl_user')
            ->references('id_user')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tata_usaha');
    }
};
