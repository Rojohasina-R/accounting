<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function showBilan()
    {
        $actifs = [];
        $actifAccounts = Account::where('type', 'actif')
            ->orderBy('code')
            ->get();
        foreach ($actifAccounts as $actif) {
            $total = $actif->lines->sum(function ($line) {
                return $line->debit - $line->credit;
            });
            $actifs[] = [
                'name' => $actif->name,
                'total' => $total
            ];
        }

        $passifs = [];
        $passifAccounts = Account::where('type', 'passif')
            ->orderBy('code')
            ->get();
        foreach ($passifAccounts as $passif) {
            $total = $passif->lines->sum(function ($line) {
                return $line->credit - $line->debit;
            });
            $passifs[] = [
                'name' => $passif->name,
                'total' => $total
            ];
        }

        $totalActif = collect($actifs)->sum('total');
        $totalPassif = collect($passifs)->sum('total');

        return view('reporting.bilan', compact(['actifs', 'passifs', 'totalActif', 'totalPassif']));
    }
}
