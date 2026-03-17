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
        Schema::create('session_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('id_terrain')->constrained('terrains', 'id_terrain')->cascadeOnDelete();
            $table->dateTime('date_session');
            $table->integer('tirs_tentes')->default(0);
            $table->integer('tirs_reussis')->default(0);
            $table->integer('raquette_tentes')->default(0);
            $table->integer('raquette_reussis')->default(0);
            $table->integer('mid_tentes')->default(0);
            $table->integer('mid_reussis')->default(0);
            $table->integer('trois_pts_tentes')->default(0);
            $table->integer('trois_pts_reussis')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_stats');
    }
};
