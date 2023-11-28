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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('aksi');
            $table->string('kehadiran');
            $table->unsignedBigInteger('id_biro_kemahasiswaan')->nullable();
            $table->timestamps();

            $table->foreign('id_biro_kemahasiswaan')->references('id')->on('biro_kemahasiswaans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
