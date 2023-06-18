<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();
        $startDate = null;
        $endDate = null;
        $paymentType = null;

        // Apply the date filter if the start and end dates are provided
        if ($request->filled(['start_date', 'end_date'])) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

            $query->whereBetween('date', [$startDate, $endDate]);
        }

        // Apply the payment type filter if a payment type is selected
        if ($request->filled('payment_type')) {
            $paymentType = $request->input('payment_type');

            $query->where('payment_type', $paymentType);
        }

        // Retrieve the paginated customers based on the filters
        $customers = $query->paginate(10);

        // Pass the filtered customers and the filter values to the view
        return view('customers.index', compact('customers', 'startDate', 'endDate', 'paymentType'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function whatsapp(Request $request)
    {
        // Retrieve the filtered customers for sending WhatsApp messages
        $query = Customer::query();

        // Filter by date (30 days or more in the past)
        $query->where('date', '<=', Carbon::now()->subDays(24));

        // Apply additional filters if provided
        if ($request->has('date')) {
            $query->where('date', $request->date);
        }

        // Exclude customers with session_type 'Correction'
        $query->where('session_type', '!=', 'Correction');

        // Paginate the results
        $customers = $query->paginate(10);

        return view('whatsapp', compact('customers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'date' => 'required',
            'area' => 'required',
            'price' => 'required',
            'payment_type' => 'required',
            'session_type' => 'required|in:Correction,Session',
        ]);

        if ($validatedData['session_type'] === 'Correction') {
            $validatedData['price'] = 0;
        }

        Customer::create($validatedData);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'date' => 'required',
            'area' => 'required',
            'price' => 'required',
            'payment_type' => 'required',
            'session_type' => 'required|in:Correction,Session',
        ]);

        if ($validatedData['session_type'] === 'Correction') {
            $validatedData['price'] = 0;
        }

        $customer->update($validatedData);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
