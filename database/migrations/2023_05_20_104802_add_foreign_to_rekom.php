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
        Schema::table('rekom', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pimpinan');

            $table->foreign('id_pimpinan')->references('id_pimpinan')->on('pimpinan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekom', function (Blueprint $table) {
            //
        });
    }
};
