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
Schema::create('shoe_tag', function (Blueprint $table) {
        $table->id();
        // foreignId pour le tag
        $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
        // foreignId pour la chaussure (on précise la colonne de référence car c'est id_chaussure)
        $table->foreignId('shoe_id')->constrained('chaussures', 'id_chaussure')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoe_tag');
    }

};
