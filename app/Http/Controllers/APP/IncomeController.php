<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use App\Models\PaymentLogbook;
use Auth;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $incomes = PaymentLogbook::where('name', 'payin')->get();
        return view('app.income.index', compact('incomes'));
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
            'income_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        // Store income in payment_logbooks
        PaymentLogbook::create([
            'user_id' => Auth::id(),
            'name' => 'payin', // always 'payin' for incomes
            'amount' => $request->amount,
            'reason' => $request->income_name,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Income added successfully!');

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

        $income = PaymentLogbook::findOrFail($id);

        // Only allow update if name is 'payin'
        if ($income->name !== 'payin') {
            return redirect()->back()->with('error', 'This income cannot be edited.');
        }

        $request->validate([
            'income_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $income->update([
            'reason' => $request->income_name,
            'amount' => $request->amount,
            'created_at' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Income updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $income = PaymentLogbook::findOrFail($id);

        // Optional: Prevent deleting sales-related entries
        if ($income->name !== 'payin') {
            return redirect()->back()->with('error', 'This entry cannot be deleted.');
        }

        $income->delete();

        return redirect()->back()->with('success', $income->reason . ' Income deleted successfully!');

    }
}
