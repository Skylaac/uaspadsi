<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->string('id_jadwal')->primary();
            $table->string('id_user');
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->time('jam_pulang');
            $table->enum('shift', ['pagi', 'siang', 'malam']);
            $table->timestamps();

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
