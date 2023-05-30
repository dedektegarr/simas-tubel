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
        Schema::create('rekom', function (Blueprint $table) {
            $table->id('id_rekom');
            $table->unsignedBigInteger('id_pegawai');
            $table->string('no_rekom');
            $table->string('universitas');
            $table->date('tgl_rekom');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekom');
    }
};