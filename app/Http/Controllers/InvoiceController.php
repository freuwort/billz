<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $profit = [
            'paid' => 0,
            'cancelled' => 0,
            'pending' => 0,
            'draft' => 0,
        ];
        
        foreach ($request->user()->invoices as $invoice)
        {
            $profit[$invoice->status] += $invoice->total;
        }

        return Inertia::render('Invoice/Index', [
            'profit' => $profit,
            'invoices' => $request->user()->invoices()->orderBy('number', 'desc')
                ->paginate()
                ->transform(function ($invoice) {
                    return [
                        'id' => $invoice->id,
                        'number' => $invoice->number,
                        'date' => $invoice->date,
                        'status' => $invoice->status,
                        'customer' => $invoice->customer,
                        'company' => $invoice->company,
                        'total' => $invoice->total,
                        'deleted_at' => $invoice->deleted_at,
                    ];
                }),
        ]);
    }

    public function show(Invoice $invoice)
    {
        return Inertia::render('Invoice/Show', [
            'invoice' => $invoice,
        ]);
    }



    public function create()
    {
        return Inertia::render('Invoice/Create', [
            'customers' => Customer::orderBy('name')->get(),
            'companies' => Company::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => ['required', 'max:255'],
            'date' => ['required', 'date'],
            'customer_id' => ['required', 'exists:customers,id'],
            'company_id' => ['required', 'exists:companies,id'],
            'timespan_start' => ['required', 'date'],
            'timespan_end' => ['required', 'date'],
            'items' => ['required', 'array'],
            'items.*.description' => ['required', 'max:255'],
            'items.*.quantity' => ['required', 'numeric'],
            'items.*.price' => ['required', 'numeric'],
            'currency' => ['nullable', 'max:3'],
            'footnote' => ['nullable', 'max:1023'],
        ]);

        $invoice = $request->user()->invoices()->create($request->all());

        foreach ($request->items as $item) {
            $invoice->items()->create($item);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created.');
    }



    public function edit(Invoice $invoice)
    {
        return Inertia::render('Invoice/Edit', [
            'invoice' => $invoice,
            'customers' => Customer::orderBy('name')->get(),
            'companies' => Company::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'number' => ['required', 'max:255'],
            'date' => ['required', 'date'],
            'customer_id' => ['required', 'exists:customers,id'],
            'company_id' => ['required', 'exists:companies,id'],
            'timespan_start' => ['required', 'date'],
            'timespan_end' => ['required', 'date'],
            'items' => ['required', 'array'],
            'items.*.description' => ['required', 'max:255'],
            'items.*.quantity' => ['required', 'numeric'],
            'items.*.price' => ['required', 'numeric'],
            'currency' => ['nullable', 'max:3'],
            'footnote' => ['nullable', 'max:1023'],
        ]);

        $invoice->update($request->all());

        $invoice->items()->delete();

        foreach ($request->items as $item) {
            $invoice->items()->create($item);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice updated.');
    }



    public function destroy(Invoice $invoice)
    {
        $invoice->forceDelete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted.');
    }

    public function restore(Invoice $invoice)
    {
        $invoice->restore();

        return redirect()->route('invoices.index')->with('success', 'Invoice restored.');
    }



    public function download(Invoice $invoice)
    {
        $company = $invoice->company;
        $customer = $invoice->customer;

        $pdf = Pdf::loadView('invoice', [
            'company' => [
                'name' => $company->name,
                'description' => $company->description,
                'phone' => $company->phone,
                'email' => $company->email,
                'address' => $company->address,
                'bank' => $company->bank,
                'tax_id' => $company->tax_id,
                'office' => $company->office,
            ],
            'customer' => [
                'name' => $customer->name,
                'address' => $customer->address,
            ],
            'invoice' => [
                'number' => $invoice->number,
                'date' => $invoice->date,
                'timespan' => [$invoice->timespan_start, $invoice->timespan_end],
                'items' => $invoice->items,
                'total' => $invoice->total,
            ],
            'footnote' => '<b>Gemäß § 19 USTG</b> (Kleinunternehmer- Regelung) keine Umsatzsteuer enthalten. Bitte überweisen Sie den Betrag innerhalb von 14 Tagen nach Erhalt der Rechnung mit Angabe der Rechnungsnummer an die untenstehende Bankverbindung.',
        ]);

        $pdf->setPaper('a4', 'portrait');
        $pdf->setWarnings(false);

        $name = ['rechnung', $invoice->number, date('dmY', $invoice->date->timestamp).'.pdf'];

        return $pdf->download(implode('_', $name));
    }
}
