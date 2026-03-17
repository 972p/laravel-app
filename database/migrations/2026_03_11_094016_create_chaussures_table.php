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
        Schema::create('chaussures', function (Blueprint $table) {
            $table->id('id_chaussure');
            $table->string('marque');
            $table->string('modele');
            $table->integer('pointure');
            $table->string('etat')->default('neuf');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chaussures');
    }
};
