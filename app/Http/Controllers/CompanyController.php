<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Company/Index', [
            'companies' => Company::orderBy('id')
                ->paginate()
                ->transform(function ($company) {
                    return [
                        'id' => $company->id,
                        'name' => $company->name,
                        'description' => $company->description,
                        'email' => $company->email,
                        'phone' => $company->phone,
                        'deleted_at' => $company->deleted_at,
                    ];
                }),
        ]);
    }

    public function show(Company $company)
    {
        return Inertia::render('Company/Show', [
            'company' => $company,
        ]);
    }



    public function create()
    {
        return Inertia::render('Company/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'max:255'],
            'tax_id' => ['nullable', 'max:255'],
            'office' => ['nullable', 'max:255'],
            'bank_name' => ['required', 'max:255'],
            'bank_account_holder' => ['required', 'max:255'],
            'bank_iban' => ['required', 'max:255'],
            'bank_bic' => ['required', 'max:255'],
            'address_name' => ['required', 'max:255'],
            'address_street' => ['required', 'max:255'],
            'address_zip' => ['required', 'max:255'],
            'address_city' => ['required', 'max:255'],
            'address_country' => ['nullable', 'max:255'],
        ]);

        $request->user()->companies()->create($request->all());

        return redirect()->route('companies.index')->with('success', 'Company created.');
    }



    public function edit(Company $company)
    {
        return Inertia::render('Company/Edit', [
            'company' => $company,
        ]);
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'max:255'],
            'tax_id' => ['nullable', 'max:255'],
            'office' => ['nullable', 'max:255'],
            'bank_name' => ['required', 'max:255'],
            'bank_account_holder' => ['required', 'max:255'],
            'bank_iban' => ['required', 'max:255'],
            'bank_bic' => ['required', 'max:255'],
            'address_name' => ['required', 'max:255'],
            'address_street' => ['required', 'max:255'],
            'address_zip' => ['required', 'max:255'],
            'address_city' => ['required', 'max:255'],
            'address_country' => ['nullable', 'max:255'],
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')->with('success', 'Company updated.');
    }



    public function destroy(Company $company)
    {
        $company->forceDelete();

        return redirect()->route('companies.index')->with('success', 'Company deleted.');
    }

    public function restore(Company $company)
    {
        $company->restore();

        return redirect()->route('companies.index')->with('success', 'Company restored.');
    }
}
