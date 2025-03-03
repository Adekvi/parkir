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
        Schema::create('penghargaans', function (Blueprint $table) {
            $table->id();
            $table->string('jenisKendaraan')->nullable();
            $table->unsignedBigInteger('id_lokasiParkir')->nullable();
            $table->foreign('id_lokasiParkir')->references('id')
                ->on('jam_lokasis')
                ->onDelete('cascade');
            $table->integer('harga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghargaans');
    }
};
