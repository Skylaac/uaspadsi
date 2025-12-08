<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('evaluasi', function (Blueprint $table) {
            $table->string('id_evaluasi', 10)->primary();
            $table->string('id_user', 10); // bukan id_karyawan
            $table->string('nama', 100);
            $table->string('periode');
            $table->string('penilaian_kerja');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluasi');
    }
};
