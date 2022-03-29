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
        ]);
        Journal::create([
            'name' => 'Achats',
            'code' => 'ACH',
        ]);
        Journal::create([
            'name' => 'Banque',
            'code' => 'BNQ',
        ]);
        Journal::create([
            'name' => 'Caisse',
            'code' => 'CAI',
        ]);
        Journal::create([
            'name' => 'Opérations diverses',
            'code' => 'OD',
        ]);
    }
}
