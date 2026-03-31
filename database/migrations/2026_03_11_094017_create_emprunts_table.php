<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emprunts', function (Blueprint $table) {
            $table->id('id_emprunt');
            $table->dateTime('date_debut');
            $table->dateTime('date_expiration');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('id_ballon')->nullable()->constrained('ballons', 'id_ballon')->onDelete('cascade');
            $table->foreignId('id_chaussure')->nullable()->constrained('chaussures', 'id_chaussure')->onDelete('cascade');
            $table->dateTime('date_retour')->nullable();
            $table->string('statut')->default('En cours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprunts');
    }
};
