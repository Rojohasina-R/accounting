<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Rules\Balance;
use App\Models\Account;
use App\Models\Journal;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $journals = Journal::all();
        $accounts = Account::orderBy('code')->get();
        return view('transactions.create', compact(['journals', 'accounts']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'journal_id' => 'required|exists:journals,id',
            'date' => 'required|date_format:d/m/Y|before_or_equal:' . date('Y-m-d'),
            'lines' => ['required', 'array', 'min:2', new Balance()],
            'lines.*' => ['array:account_id,debit,credit'],
            'lines.*.account_id' => 'required|exists:accounts,id',
            'lines.*.debit' => 'nullable|integer|gt:0',
            'lines.*.credit' => 'nullable|integer|gt:0',
        ]);

        $transaction = Transaction::create([
            'name' => request('name'),
            'journal_id' => request('journal_id'),
            'date' => Carbon::createFromFormat('d/m/Y', request('date'))->toDateString(),
        ]);

        foreach (request('lines') as $line) {
            $transaction->lines()->create($line);
        }

        return ['here'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
