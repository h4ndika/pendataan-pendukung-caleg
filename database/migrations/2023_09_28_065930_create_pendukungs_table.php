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
        Schema::create('pendukungs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wilayah_id')->nullable();
            $table->foreign('wilayah_id')->references('id')->on('wilayahs');
            $table->string('nama_pendukung');
            $table->string('phone')->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->integer('tps')->nullable();
            $table->string('point')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendukungs');
    }
};
