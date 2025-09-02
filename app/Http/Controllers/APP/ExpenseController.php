<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use App\Models\PaymentLogbook;
use Auth;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = PaymentLogbook::where('name', 'payout')->get();
        return view('app.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validate form inputs
        $request->validate([
            'expences_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        // Store expense in payment_logbooks
        PaymentLogbook::create([
            'user_id' => Auth::id(),
            'name' => 'payout', // always 'payout' for expenses
            'amount' => $request->amount,
            'reason' => $request->expences_name,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Expenses added successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $expense = PaymentLogbook::findOrFail($id);

        // Only allow update if name is 'payout'
        if ($expense->name !== 'payout') {
            return redirect()->back()->with('error', 'This expense cannot be edited.');
        }

        $request->validate([
            'expences_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $expense->update([
            'reason' => $request->expences_name,
            'amount' => $request->amount,
            'created_at' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Expense updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = PaymentLogbook::findOrFail($id);

        // Only allow deletion for expenses (name = 'payout')
        if ($expense->name !== 'payout') {
            return redirect()->back()->with('error', 'This entry cannot be deleted.');
        }

        $expense->delete();

        return redirect()->back()->with('success', $expense->reason . ' expense deleted successfully!');
    }
}
