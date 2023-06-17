<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();

        // Filter by start date
        if ($request->has('start_date')) {
            $query->where('expense_date', '>=', $request->start_date);
        }

        // Filter by end date
        if ($request->has('end_date')) {
            $query->where('expense_date', '<=', $request->end_date);
        }

        $expenses = $query->paginate(30);

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'expense_name' => 'required',
            'expense_amount' => 'required',
            'expense_date' => 'required',
        ]);

        Expense::create($validatedData);

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validatedData = $request->validate([
            'expense_name' => 'required',
            'expense_amount' => 'required',
            'expense_date' => 'required',
        ]);

        $expense->update($validatedData);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
