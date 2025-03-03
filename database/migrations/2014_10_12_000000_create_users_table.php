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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('namaLengkap');
            $table->string('username')->unique();
            $table->string('jekel')->nullable();
            $table->date('tglLahir')->nullable();
            $table->string('tempatLahir')->nullable();
            $table->unsignedBigInteger('id_lokasiParkir')->nullable();
            $table->foreign('id_lokasiParkir')->references('id')
                ->on('jam_lokasis')
                ->onDelete('cascade');
            $table->string('namaLokasi')->nullable();
            $table->foreign('namaLokasi')->references('kodeJln')
                ->on('jalans');
                // ->on('cascade');
            $table->text('fotoKtp')->nullable();
            $table->unsignedBigInteger('id_shift')->nullable();
            $table->foreign('id_shift')->references('id')
                ->on('shifts')
                ->onDelete('cascade');
            $table->string('role')->default('user');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_complete')->default(false);
            $table->boolean('status')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
