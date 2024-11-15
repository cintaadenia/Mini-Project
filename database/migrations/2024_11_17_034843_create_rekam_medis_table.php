<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('rekam_medis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
        $table->text('diagnosa');
        $table->text('tindakan');
        $table->timestamps();
    });
}

/**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
