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
        Schema::create('rekap_parkirs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_shift');
            $table->foreign('id_shift')->references('id')
                ->on('shifts')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_lokasiParkir')->nullable();
            $table->foreign('id_lokasiParkir')->references('id')
                ->on('jam_lokasis')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_kolektor')->nullable();
            $table->foreign('id_kolektor')->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('kodeJln')->nullable();
            $table->foreign('kodeJln')->references('kodeJln')
                ->on('jalans')
                ->onDelete('cascade');
            $table->date('tglSetor')->nullable();
            $table->string('rekapDiterima')->nullable();
            $table->string('persenSetor')->nullable();
            $table->integer('jumlahMotor')->nullable();
            $table->integer('jumlahMobil')->nullable();
            $table->integer('nilaiMotor')->nullable();
            $table->integer('nilaiMobil')->nullable();
            $table->integer('total')->nullable();
            $table->string('keterangan')->nullable();
            $table->enum('status', ['Kolektor', 'Kasir']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_parkirs');
    }
};
