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
    Schema::create('obats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('resep_id')->constrained('reseps')->onDelete('cascade');
        $table->string('nama_obat');
        $table->integer('jumlah');
        $table->string('dosis');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
