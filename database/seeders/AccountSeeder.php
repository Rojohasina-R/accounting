<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('accounts')->truncate();

        Account::create([
            'name' => 'Clients',
            'code' => '411',
            'type' => 'actif',
        ]);
        Account::create([
            'name' => 'Capital',
            'code' => '101',
            'type' => 'passif',
        ]);
        Account::create([
            'name' => 'Fournisseurs',
            'code' => '401',
            'type' => 'passif',
        ]);
        Account::create([
            'name' => 'Banque',
            'code' => '512',
            'type' => 'actif',
        ]);
        Account::create([
            'name' => 'Caisse',
            'code' => '530',
            'type' => 'actif',
        ]);
        /*Account::create([
            'name' => 'Achats',
            'code' => '601',
            'type' => 'charge',
        ]);*/
        Account::create([
            'name' => 'Poussins',
            'code' => '6011',
            'type' => 'charge',
        ]);
        Account::create([
            'name' => 'Démarrage',
            'code' => '6012',
            'type' => 'charge',
        ]);
        Account::create([
            'name' => 'Finition',
            'code' => '6013',
            'type' => 'charge',
        ]);
        Account::create([
            'name' => 'Vitamines',
            'code' => '6014',
            'type' => 'charge',
        ]);
        Account::create([
            'name' => 'Taimbakona',
            'code' => '6015',
            'type' => 'charge',
        ]);
        Account::create([
            'name' => 'Transports',
            'code' => '624',
            'type' => 'charge',
        ]);
        Account::create([
            'name' => 'Frais de télécommunications',
            'code' => '626',
            'type' => 'charge',
        ]);
        Account::create([
            'name' => 'Ventes poulets',
            'code' => '701',
            'type' => 'produit',
        ]);
        Account::create([
            'name' => 'Ventes zezika',
            'code' => '703',
            'type' => 'produit',
        ]);
    }
}
