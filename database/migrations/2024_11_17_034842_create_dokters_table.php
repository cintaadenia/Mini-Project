<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Update the dokter migration file to include user_id
public function up()
{
    Schema::create('dokters', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('spesialis');
        $table->string('no_hp')->unique();
        $table->string('image')->nullable();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Add user_id column with foreign key
        $table->timestamps();
    });
}

   /**
     * Reverse the migrations.
     */     
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
