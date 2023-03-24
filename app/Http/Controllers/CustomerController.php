<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Customer/Index', [
            'customers' => Customer::orderBy('id')
                ->paginate()
                ->transform(function ($customer) {
                    return [
                        'id' => $customer->id,
                        'name' => $customer->name,
                        'email' => $customer->email,
                        'phone' => $customer->phone,
                        'deleted_at' => $customer->deleted_at,
                    ];
                }),
        ]);
    }

    public function show(Customer $customer)
    {
        return Inertia::render('Customer/Show', [
            'customer' => $customer,
        ]);
    }



    public function create()
    {
        return Inertia::render('Customer/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'max:255'],
            'address_name' => ['required', 'max:255'],
            'address_street' => ['required', 'max:255'],
            'address_zip' => ['required', 'max:255'],
            'address_city' => ['required', 'max:255'],
            'address_country' => ['nullable', 'max:255'],
        ]);
        
        $request->user()->customers()->create($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer created.');
    }



    public function edit(Customer $customer)
    {
        return Inertia::render('Customer/Edit', [
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'max:255'],
            'address_name' => ['required', 'max:255'],
            'address_street' => ['required', 'max:255'],
            'address_zip' => ['required', 'max:255'],
            'address_city' => ['required', 'max:255'],
            'address_country' => ['nullable', 'max:255'],
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }



    public function destroy(Customer $customer)
    {
        $customer->forceDelete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted.');
    }

    public function restore(Customer $customer)
    {
        $customer->restore();

        return redirect()->route('customers.index')->with('success', 'Customer restored.');
    }
}
