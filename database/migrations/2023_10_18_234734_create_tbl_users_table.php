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
        Schema::create('tbl_user', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->integer('id_user', true);
            $table->string('username', 60);
            $table->string('password');
            $table->enum('role',['siswa','pengurus','walikelas','gurupiket','gurubk','tatausaha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user');
    }
};
