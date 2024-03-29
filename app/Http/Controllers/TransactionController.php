<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Department;
use App\Http\Requests\StoreTransaction;
use App\Http\Requests\UpdateTransaction;
use App\Services\TransactionService;
use Auth;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function __construct(TransactionService $transaction)
    {
        $this->transaction = $transaction;
        $this->authorizeResource(Transaction::class);
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::All();
        $departments = Department::All();
        return view('transactions.index')->with('transactions', $transactions)->with('departments', $departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaction $request)
    {
        $transaction = Transaction::create(array_merge($request->validated(), ['user_id' => Auth::Id()]));
        if ($transaction->operation_type === 'sale') {
            $disc = $transaction->disc;
            $disc->sold = 1;
            $disc->save();
        }
        Log::info(Auth::user()->fullName . ' made a transaction of disc #' . $transaction->disc->id);
        return redirect()->route('transactions.index')->with('success', __('transactions.successfully_stored'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
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
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaction $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        return redirect()->route('transactions.index')->with('success', __('transactions.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        Log::info(Auth::user()->fullName . ' deleted transaction #' . $transaction->id);
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', __('transactions.successfully_deleted'));
    }

    public function report()
    {
        $this->transaction->report();
        return redirect()->route('transactions.index')->with('success', __('transactions.succesfully_mailed'));
    }
}
