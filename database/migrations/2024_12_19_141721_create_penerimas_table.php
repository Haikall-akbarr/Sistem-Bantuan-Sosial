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
        Schema::create('penerima', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nama'); // Nama lengkap penerima
            $table->string('nik')->unique(); // Nomor Identitas Kependudukan
            $table->string('alamat'); // Alamat penerima
            $table->string('no_hp')->nullable(); // Nomor telepon
            $table->timestamps(); // Created at & Updated at
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima');
    }
};
