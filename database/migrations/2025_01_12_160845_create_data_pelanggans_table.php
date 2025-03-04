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
        Schema::create('data_pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('namaJalan')->nullable();
            $table->date('jatuhTempo')->nullable();
            $table->string('namaPendaftar')->nullable();
            $table->string('namaSTNK')->nullable();
            $table->string('platKendaraan')->nullable();
            $table->integer('pembayaran')->nullable();
            $table->string('handphone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pelanggans');
    }
};
