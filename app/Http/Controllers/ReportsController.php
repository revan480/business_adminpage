<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function financial()
    {
        // Retrieve the necessary data for the financial report
        $totalPayments = Customer::sum('price');
        $totalExpenses = Expense::sum('expense_amount');
        $difference = $totalPayments - $totalExpenses;

        // Retrieve the daily income and expenses data for the line chart
        $dailyData = Customer::selectRaw('DATE(created_at) as date, SUM(price) as income')
            ->groupBy('date', 'created_at') // Include 'created_at' in the GROUP BY clause
            ->orderBy('date')
            ->get();

        $dailyLabels = $dailyData->pluck('date');
        $dailyIncome = $dailyData->pluck('income');
        $dailyExpenses = Expense::selectRaw('DATE(expense_date) as date, sum(expense_amount) as expense')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('expense');

        // Pass the data to the financial view
        return view('reports.financial', compact('totalPayments', 'totalExpenses', 'difference', 'dailyLabels', 'dailyIncome', 'dailyExpenses'));
    }

    public function financialReport(Request $request)
{
    // Get the start and end dates from the request
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Get the payments and expenses data from the database
    $payments = DB::table('customers')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->pluck('price')
        ->toArray();
    $expenses = Expense::whereBetween('expense_date', [$startDate, $endDate])
        ->pluck('expense_amount')
        ->toArray();

    // Calculate total payments and expenses
    $totalPayments = array_sum($payments);
    $totalExpenses = array_sum($expenses);

    // Calculate the difference between payments and expenses
    $difference = $totalPayments - $totalExpenses;

    // Get the dates for the chart labels
    $dates = DB::table('customers')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->pluck('created_at')
        ->map(function ($item) {
            return Carbon::parse($item)->format('Y-m-d');
        })
        ->toArray();

    // Get the daily income and expenses data for the line chart
    $dailyData = DB::table('customers')
        ->selectRaw('DATE(created_at) as date, SUM(price) as income')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date', 'created_at') // Include 'created_at' in the GROUP BY clause
        ->orderBy('date')
        ->get();

    $dailyLabels = $dailyData->pluck('date');
    $dailyIncome = $dailyData->pluck('income');
    $dailyExpenses = Expense::selectRaw('DATE(expense_date) as date, SUM(expense_amount) as expense')
        ->whereBetween('expense_date', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('expense');

    // Pass the data to the financial view
    return view('reports.financial', compact('dates', 'totalPayments', 'totalExpenses', 'difference', 'dailyLabels', 'dailyIncome', 'dailyExpenses', 'startDate', 'endDate'));
}

}
