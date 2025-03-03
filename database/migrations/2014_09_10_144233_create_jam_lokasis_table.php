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
        Schema::create('jam_lokasis', function (Blueprint $table) {
            $table->id();
            $table->string('kodeJln')->nullable();
            $table->foreign('kodeJln')->references('kodeJln')
                ->on('jalans')
                ->onDelete('cascade');
            $table->integer('durasiParkir')->nullable();
            $table->string('tmptParkir')->nullable();
            $table->string('tipe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jam_lokasis');
    }
};
