<?php

namespace Database\Seeders;

use App\Models\Journal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('journals')->truncate();

        Journal::create([
            'name' => 'Ventes',
            'code' => 'VTE',
            'display' => 'Journal de ventes',
        ]);
        Journal::create([
            'name' => 'Achats',
            'code' => 'ACH',
            'display' => "Journal d'achats",
        ]);
        Journal::create([
            'name' => 'Banque',
            'code' => 'BNQ',
            'display' => 'Journal de banque',
        ]);
        Journal::create([
            'name' => 'Caisse',
            'code' => 'CAI',
            'display' => 'Journal de caisse',
        ]);
        Journal::create([
            'name' => 'Opérations diverses',
            'code' => 'OD',
            'display' => "Journal d'opérations diverses",
        ]);
    }
}
