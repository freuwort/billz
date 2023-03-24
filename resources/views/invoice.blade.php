<?php
function formatPrice($price, $currency = '€')
{
    return number_format($price, 2, ',', '.') . ' ' . $currency;
}

function formatDecimal($number)
{
    return number_format($number, 2, ',', '.');
}

function formatDate($date)
{
    return date_format(date_create($date), 'd.m.Y');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"> --}}
    
    <title>Rechnung: {{$invoice['number']}}</title>
</head>
<body>
    <section class="head">
        <h1>
            <b>{{$company['name']}}</b><br>
            <span>{{$company['description']}}</span>
        </h1>
    </section>
    
    <section class="parties-details">
        <table>
            <tbody>
                <tr>
                    <td style="width: 50%;" class="company-details">
                        <small>Dienstleister</small>
                        <b>{{$company['address']['name']}}</b><br>
                        <span>{{$company['address']['street']}}</span><br>
                        <span>{{$company['address']['zip']}}</span> <span>{{$company['address']['city']}}</span><br>
                        <span>{{$company['address']['country']}}</span><br>
                        <br>
                        <span>Steuernummer: {{$company['tax_id']}}</span><br>
                        <span>{{$company['office']}}</span>
                    </td>
                    <td style="width: 50%;" class="customer-details">
                        <small>Kunde</small>
                        <b>{{$customer['name']}}</b><br>
                        <span>{{$customer['address']['street']}}</span><br>
                        <span>{{$customer['address']['zip']}}</span> <span>{{$customer['address']['city']}}</span><br>
                        <span>{{$customer['address']['country']}}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="invoice-details">
        <h2>Rechnung</h2>

        <table>
            <tbody>
                <tr>
                    <td style="width: 33%;">Rechnungsdatum:</td>
                    <td style="width: 67%;">{{formatDate($invoice['date'])}}</td>
                </tr>
                <tr>
                    <td>Abrechnungszeitraum:</td>
                    <td>
                        {{formatDate($invoice['timespan'][0])}} bis
                        {{formatDate($invoice['timespan'][1])}}
                    </td>
                </tr>
                <tr>
                    <td>Rechnungsnummer:</td>
                    <td>{{$invoice['number']}}</td>
                </tr>
            </tbody>
        </table>

        <table class="item-table">
            <thead>
                <tr>
                    <th>Beschreibung</th>
                    <th style="width: 16%;" class="right">Preis</th>
                    <th style="width: 16%;" class="right">Anzahl</th>
                    <th style="width: 20%;" class="right">Summe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice['items'] as $item)
                    <tr>
                        <td>{{$item['description']}}</td>
                        <td class="mono right">{{formatPrice($item['price'])}}</td>
                        <td class="mono right">{{formatDecimal($item['quantity'])}}</td>
                        <td class="mono right">{{formatPrice($item['total'])}}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="3"><b>Rechnungsbetrag</b></td>
                    <td class="mono right"><b>{{formatPrice($invoice['total'])}}</b></td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="footer">
        <small>{!!$footnote!!}</small>
        <table>
            <tbody>
                <tr>
                    <td style="width: 50%;" class="mono">{{$company['bank']['account_holder']}}</td>
                    <td style="width: 50%;" class="mono">IBAN:&nbsp;{{$company['bank']['iban']}}</td>
                </tr>
                <tr>
                    <td class="mono">{{$company['bank']['name']}}</td>
                    <td class="mono">BIC:&nbsp;&nbsp;{{$company['bank']['bic']}}</td>
                </tr>
            </tbody>
        </table>
    </section>
</body>

<style>
    *, *::before, *::after
    {
        box-sizing: border-box;
    }

    html
    {
        padding: 2rem;
    }

    body
    {
        font-family: sans-serif;
        margin: 0;
        padding: 0;
        line-height: 1.5
    }

    .left
    {
        text-align: left !important;
    }

    .right
    {
        text-align: right !important;
    }

    .mono
    {
        font-family: monospace;
        font-size: 1rem;
    }



    .head
    {
        margin-bottom: 2rem;
    }

    .head h1
    {
        margin: 0;
        padding: 0;
        font-size: 1.25rem;
        line-height: 1.25;
    }

    .head h1 b
    {
        color: #650db4;
    }

    .head h1 span
    {
        font-size: 1rem;
        font-weight: 400;
    }



    .parties-details
    {
        margin-bottom: 4rem;
    }
    
    .parties-details table
    {
        width: 100%;
        border-collapse: collapse;
    }

    .parties-details table td
    {
        vertical-align: top;
    }

    .parties-details small
    {
        display: block;
        text-transform: uppercase;
        font-size: .9rem;
        font-weight: 400;
        letter-spacing: 1px;
        color: #aaa;
        margin-bottom: .5rem
    }



    .invoice-details
    {
        margin-bottom: 4rem;
    }
    
    .invoice-details h2
    {
        margin: 0;
        margin-bottom: 1rem;
        padding: 0;
        font-size: 2rem;
        font-weight: 400;
    }

    .invoice-details table
    {
        width: 100%;
        border-spacing: 0;
        margin-bottom: 2rem;
    }

    .item-table
    {
        table-layout: fixed;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: .5rem;
        border-spacing: 0;
    }

    .item-table th
    {
        border-bottom: 2px solid #000;
        padding: .5rem 1rem;
        text-align: left;
        font-size: 1rem;
    }

    .item-table td
    {
        padding: .5rem 1rem;
        text-align: left;
        font-size: 1rem;
    }

    .item-table tbody tr:nth-child(odd)
    {
        background-color: #f2f2f2;
    }

    .item-table tbody tr:last-child
    {
        background-color: transparent;
    }
    
    .item-table tbody tr:last-child td
    {
        border-top: 2px solid #000;
    }



    .footer small
    {
        display: block;
        border-bottom: 1px solid #ddd;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .footer table
    {
        width: 100%;
        border-spacing: 0;
    }
</style>
</html>
