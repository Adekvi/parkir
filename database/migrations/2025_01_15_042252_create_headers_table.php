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
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            $table->string('header1')->nullable();
            $table->string('header2')->nullable();
            $table->string('header3')->nullable();
            $table->string('header4')->nullable();
            $table->string('footer1')->nullable();
            $table->string('footer2')->nullable();
            $table->string('footer3')->nullable();
            $table->string('footer4')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headers');
    }
};
