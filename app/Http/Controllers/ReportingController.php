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

            if ($passif->name === 'Résultat') {
                $gestionAccounts = Account::whereIn('type', ['charge', 'produit'])
                    ->get();
                foreach ($gestionAccounts as $gestion) {
                    $total = $total + $gestion->lines->sum(function ($line) {
                        return $line->credit - $line->debit;
                    });
                }
            }

            $passifs[] = [
                'name' => $passif->name,
                'total' => $total
            ];
        }

        $totalActif = collect($actifs)->sum('total');
        $totalPassif = collect($passifs)->sum('total');

        return view('reporting.bilan', compact(['actifs', 'passifs', 'totalActif', 'totalPassif']));
    }

    public function showResultat()
    {
        $charges = [];
        $chargeAccounts = Account::where('type', 'charge')
            ->orderBy('code')
            ->get();
        foreach ($chargeAccounts as $charge) {
            $total = $charge->lines->sum(function ($line) {
                return $line->debit - $line->credit;
            });
            $charges[] = [
                'name' => $charge->name,
                'total' => $total
            ];
        }

        $produits = [];
        $produitAccounts = Account::where('type', 'produit')
            ->orderBy('code')
            ->get();
        foreach ($produitAccounts as $produit) {
            $total = $produit->lines->sum(function ($line) {
                return $line->credit - $line->debit;
            });
            $produits[] = [
                'name' => $produit->name,
                'total' => $total
            ];
        }

        $totalCharges = collect($charges)->sum('total');
        $totalProduits = collect($produits)->sum('total');
        $resultat = $totalProduits - $totalCharges;

        return view('reporting.resultat', compact(['charges', 'produits', 'totalCharges', 'totalProduits', 'resultat']));
    }

    public function showGrandLivre()
    {
        $accounts = Account::whereIn('type', ['charge', 'produit'])
            ->orWhereIn('name', ['Banque', 'Caisse'])
            ->orderBy('code')
            ->get();
        return view('reporting.grand-livre', compact(['accounts']));
    }

    public function showGrandLivreData(Account $account)
    {
        $lines = $account->lines()
            ->with('transaction')
            /*->join('transactions', 'transactions.id', '=', 'lines.transaction_id')
            ->orderBy('transactions.date', 'desc')*/
            ->get();
        return view('reporting._grand-livre', compact(['lines']));
    }
}
