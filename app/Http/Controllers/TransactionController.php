<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Rules\Balance;
use App\Models\Account;
use App\Models\Journal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Repositories\TransactionRepository;

class TransactionController extends Controller
{
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateTransaction();

        $id = $this->transactionRepository->updateOrCreate(new Transaction(), $attributes);

        return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transactions._show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
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
        $attributes = $this->validateTransaction();

        $id = $this->transactionRepository->updateOrCreate($transaction, $attributes);

        return $id;
    }

    protected function validateTransaction()
    {
        return request()->validate([
            'name' => 'required|max:255',
            'journal_id' => 'required|exists:journals,id',
            'date' => 'required|date_format:d/m/Y|before_or_equal:' . date('Y-m-d'),
            'lines' => ['required', 'array', 'min:2', new Balance()],
            'lines.*' => ['array:account_id,debit,credit'],
            'lines.*.account_id' => 'required|exists:accounts,id',
            'lines.*.debit' => 'nullable|integer|gt:0',
            'lines.*.credit' => 'nullable|integer|gt:0',
        ]);
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
