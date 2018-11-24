<!DOCTYPE html>
<html lang="{{$config->getLanguage()}}"  dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $config->name }}</title>
    @if($config->getIsRTL() == true)
        <link rel="stylesheet"  href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css"  integrity="sha384-P4uhUIGk/q1gaD/NdgkBIl3a6QywJjlsFJFk7SPRdruoGddvRVSwv5qFnvZ73cpz"  crossorigin="anonymous">
    @else
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    @endif
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1,h2,h3,h4,p,span,div { font-family: DejaVu Sans, sans-serif; }
    </style>
</head>
<body >
<div style="clear:both; position:relative;">
    <div style="position:absolute; left:0pt; width:250pt;">
        <img class="img-rounded" height="{{ $config->logo_height }}" src="{{ $config->logo }}">
    </div>
    <div style="margin-left:300pt;">
        <b>Date: </b> {{ $config->date->formatLocalized('%A %d %B %Y') }}<br />
        @if ($config->number)
            <b>Invoice #: </b> {{ $config->number }}
        @endif
        <br />
    </div>
</div>
<br />
<h2>{{ $config->name }} {{ $config->number ? '#' . $config->number : '' }}</h2>
<div style="clear:both; position:relative;">
    <div style="position:absolute; left:0pt; width:250pt;">
        <h4>Business Details:</h4>
        <div class="panel panel-default">
            <div class="panel-body">
                {!! $config->business_details->count() == 0 ? '<i>No business details</i><br />' : '' !!}
                {{ $config->business_details->get('name') }}<br />
                ID: {{ $config->business_details->get('id') }}<br />
                {{ $config->business_details->get('phone') }}<br />
                {{ $config->business_details->get('location') }}<br />
                {{ $config->business_details->get('zip') }} {{ $config->business_details->get('city') }}
                {{ $config->business_details->get('country') }}<br />
            </div>
        </div>
    </div>
    <div style="margin-left: 300pt;">
        <h4>Customer Details:</h4>
        <div class="panel panel-default">
            <div class="panel-body">
                {!! $config->customer_details->count() == 0 ? '<i>No customer details</i><br />' : '' !!}
                {{ $config->customer_details->get('name') }}<br />
                ID: {{ $config->customer_details->get('id') }}<br />
                {{ $config->customer_details->get('phone') }}<br />
                {{ $config->customer_details->get('location') }}<br />
                {{ $config->customer_details->get('zip') }} {{ $config->customer_details->get('city') }}
                {{ $config->customer_details->get('country') }}<br />
            </div>
        </div>
    </div>
</div>
<h4>Items:</h4>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>ID</th>
        <th>Item Name</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($config->items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->get('id') }}</td>
            <td>{{ $item->get('name') }}</td>
            <td>{{ $item->get('price') }} {{ $config->formatCurrency()->symbol }}</td>
            <td>{{ $item->get('ammount') }}</td>
            <td>{{ $item->get('totalPrice') }} {{ $config->formatCurrency()->symbol }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div style="clear:both; position:relative;">
    @if($config->notes)
        <div style="position:absolute; left:0pt; width:250pt;">
            <h4>Notes:</h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    {{ $config->notes }}
                </div>
            </div>
        </div>
    @endif
    <div style="margin-left: 300pt;">
        <h4>Total:</h4>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td><b>Subtotal</b></td>
                <td>{{ $config->subTotalPriceFormatted() }} {{ $config->formatCurrency()->symbol }}</td>
            </tr>
            <tr>
                <td>
                    <b>
                        Taxes {{ $config->tax_type == 'percentage' ? '(' . $config->tax . '%)' : '' }}
                    </b>
                </td>
                <td>{{ $config->taxPriceFormatted() }} {{ $config->formatCurrency()->symbol }}</td>
            </tr>
            <tr>
                <td><b>TOTAL</b></td>
                <td><b>{{ $config->totalPriceFormatted() }} {{ $config->formatCurrency()->symbol }}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@if ($config->footnote)
    <br /><br />
    <div class="well">
        {{ $config->footnote }}
    </div>
@endif
</body>
</html>
