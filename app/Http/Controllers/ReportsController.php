<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function financial()
    {
        // Retrieve the necessary data for the financial report
        $totalPayments = Customer::sum('price') ?? 0;
        $totalExpenses = Expense::sum('expense_amount') ?? 0;
        $difference = $totalPayments - $totalExpenses;
    
        // Retrieve the daily income and expenses data for the line chart
        $dailyData = Customer::selectRaw('DATE(created_at) as date, SUM(price) as income')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    
        $dailyLabels = $dailyData->pluck('date');
        $dailyIncome = $dailyData->pluck('income');
        $dailyExpenses = Expense::selectRaw('DATE(expense_date) as date, SUM(expense_amount) as expense')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('expense');
    
        // Calculate the correction percentage
        $correctionPercentage = $this->calculateCorrectionPercentage();
    
        // Pass the data to the financial view
        return view('reports.financial', compact('totalPayments', 'totalExpenses', 'difference', 'dailyLabels', 'dailyIncome', 'dailyExpenses', 'correctionPercentage'));
    }
    

    public function financialReport(Request $request)
{
    // Retrieve the necessary data for the financial report
    $totalPayments = Customer::sum('price') ?? 0;
    $totalExpenses = Expense::sum('expense_amount') ?? 0;

    // Get the start and end dates from the request
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Get the payments and expenses data from the database
    $payments = Customer::whereBetween('created_at', [$startDate, $endDate])
        ->sum('price');

    $expenses = Expense::whereBetween('expense_date', [$startDate, $endDate])
        ->sum('expense_amount');

    // Calculate the difference between payments and expenses
    $difference = $payments - $expenses;

    // Get the daily income and expenses data for the line chart
    $dailyData = Customer::selectRaw('DATE(created_at) as date, SUM(price) as income')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $dailyLabels = $dailyData->pluck('date');
    $dailyIncome = $dailyData->pluck('income');
    $dailyExpenses = Expense::selectRaw('DATE(expense_date) as date, SUM(expense_amount) as expense')
        ->whereBetween('expense_date', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('expense');

    // Calculate the correction percentage
    $correctionPercentage = $this->calculateCorrectionPercentage($startDate, $endDate);

    // Pass the data to the financial view
    return view('reports.financial', compact('payments', 'expenses', 'difference', 'dailyLabels', 'dailyIncome', 'dailyExpenses', 'startDate', 'endDate', 'correctionPercentage', 'totalPayments', 'totalExpenses'));
}


    private function calculateCorrectionPercentage($startDate = null, $endDate = null)
{
    // Get the total number of customers who had a session within the date range
    $totalSessions = Customer::whereBetween('created_at', [$startDate, $endDate])
        ->where('session_type', 'Session')
        ->count();

    // Get the number of customers who had a session and came for a correction within the date range
    $correctedSessions = Customer::whereBetween('created_at', [$startDate, $endDate])
        ->where('session_type', 'Correction')
        ->count();

    // Calculate the correction percentage
    if ($totalSessions > 0) {
        $correctionPercentage = ($correctedSessions / $totalSessions) * 100;
    } else {
        $correctionPercentage = 0;
    }

    return $correctionPercentage;
}


}