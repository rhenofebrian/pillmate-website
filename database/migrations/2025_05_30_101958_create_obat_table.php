<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->enum('jenis_obat', ['Tablet/Kapsul', 'Sirup']);
            $table->integer('jumlah_obat'); // sebelumnya jumlah_pil
            $table->enum('dikonsumsi', ['sesudah makan', 'sebelum makan']);
            $table->string('dosis')->nullable();
            $table->string('durasi')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};

