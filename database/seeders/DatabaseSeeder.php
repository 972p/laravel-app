<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Ballon::create(['marque' => 'Spalding', 'taille' => '7', 'etat' => 'neuf']);
        \App\Models\Ballon::create(['marque' => 'Spalding', 'taille' => '6', 'etat' => 'bon']);
        \App\Models\Ballon::create(['marque' => 'Wilson', 'taille' => '7', 'etat' => 'usé']);
        \App\Models\Ballon::create(['marque' => 'Nike', 'taille' => '7', 'etat' => 'nouveau']);
        \App\Models\Ballon::create(['marque' => 'Molten', 'taille' => '6', 'etat' => 'bon']);

        \App\Models\Terrain::create(['nom' => 'Terrain Principal (Intérieur)', 'type_sol' => 'parquet']);
        \App\Models\Terrain::create(['nom' => 'Terrain Annexe (Intérieur)', 'type_sol' => 'parquet']);
        \App\Models\Terrain::create(['nom' => 'Playground Nord', 'type_sol' => 'bitume']);

        \App\Models\Chaussure::create(['marque' => 'Nike', 'modele' => 'LeBron 20', 'pointure' => 43, 'etat' => 'neuf']);
        \App\Models\Chaussure::create(['marque' => 'Nike', 'modele' => 'KD 15', 'pointure' => 44, 'etat' => 'bon']);
        \App\Models\Chaussure::create(['marque' => 'Adidas', 'modele' => 'Harden Vol. 7', 'pointure' => 45, 'etat' => 'neuf']);
        \App\Models\Chaussure::create(['marque' => 'Jordan', 'modele' => 'Luka 2', 'pointure' => 42, 'etat' => 'usé']);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
