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
        Schema::create('tubel', function (Blueprint $table) {
            $table->id('id_tubel');
            $table->unsignedBigInteger('id_pegawai');
            $table->enum('jenis_tubel', ['mtbt', 'mbt', 'pk']);
            $table->enum('jenjang', ['s1', 's2', 's3', 'd3', 'd4', 'profesi']);
            $table->enum('status', ['aktif', 'selesai']);
            $table->string('universitas');
            $table->string('no_sk');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai')->nullable();
            $table->timestamps();

            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tubel');
    }
};
