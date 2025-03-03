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
        Schema::create('parkers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_shift');
            $table->foreign('id_shift')->references('id')
                ->on('shifts')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_lokasiParkir');
            $table->foreign('id_lokasiParkir')->references('id')
                ->on('jam_lokasis')
                ->onDelete('cascade');
            $table->string('kodeJln')->nullable();
            $table->foreign('kodeJln')->references('kodeJln')
                ->on('jalans')
                ->onDelete('cascade');
            $table->date('tglParkir')->nullable();
            $table->string('nopol')->nullable();
            $table->string('penerimaan')->nullable();
            $table->string('jenisKendaraan')->nullable();
            $table->string('keterangan')->nullable();
            $table->enum('status', ['Sudah disetor', 'Belum disetor'])->default('Belum disetor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkers');
    }
};
