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
        Schema::create('distribusi', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('penerima_id')->constrained('penerima')->onDelete('cascade'); // Relasi ke Penerima
            $table->foreignId('program_bantuan_id')->constrained('program_bantuan')->onDelete('cascade'); // Relasi ke Program Bantuan
            $table->date('tanggal_distribusi'); // Tanggal distribusi bantuan
            $table->string('status')->default('Diterima'); // Status distribusi (Diterima, Ditunda, Ditolak)
            $table->timestamps(); // Created at & Updated at
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusi');
    }
};
