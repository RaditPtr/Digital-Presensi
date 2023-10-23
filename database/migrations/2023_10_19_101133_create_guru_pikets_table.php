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
        Schema::create('guru_pikets', function (Blueprint $table) {
            $table->integer('id_piket', true, false)->nullable(false);
            $table->integer('id_guru', false)->nullable(false);
            $table->timestamps();

            $table->foreign('id_guru')
            ->references('id_guru')->on('guru')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_pikets');
    }
};
