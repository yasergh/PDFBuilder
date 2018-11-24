
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Test</title>
       <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1,h2,h3,h4,p,span,div { font-family: DejaVu Sans, sans-serif; }
        /*.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {*/
            /*border:0;*/
            /*padding:0;*/
            /*margin-left: 0;*/
        /*}*/
        td {
            border: 1px solid black;
        }
    </style>

</head>
<body >

<div class="row">
    <div class="col-xs-6 col-md-6">
        <div >
            <img class="img-rounded" height="60" src="{{$data->getLogo()}}">
        </div>
    </div>
    <div class="col-md-6">
        <div >
            <b>Date: </b> {{$data->getDate()}}<br />
            <b>Invoice #: </b> {{$data->getNumber()}}

            <br />
        </div>
    </div>
</div>

<h2>Test Report </h2>
<div class="row">
    <div class="col-xs-6 col-md-6">
        <div style="padding: 20px">
            <h4>Business Details:</h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! $data->getBusinessDetails()->count() == 0 ? '<i>No business details</i><br />' : '' !!}
                    {{ $data->getBusinessDetails()->get('name') }}<br />
                    ID: {{ $data->getBusinessDetails()->get('id') }}<br />
                    {{ $data->getBusinessDetails()->get('phone') }}<br />
                    {{ $data->getBusinessDetails()->get('location') }}<br />
                    {{ $data->getBusinessDetails()->get('zip') }} {{ $data->getBusinessDetails()->get('city') }}
                    {{ $data->getBusinessDetails()->get('country') }}<br />
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div style="padding: 20px">
            <h4>Customer Details:</h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! $data->getCustomerDetails()->count() == 0 ? '<i>No customer details</i><br />' : '' !!}
                    {{ $data->getCustomerDetails()->get('name') }}<br />
                    ID: {{ $data->getCustomerDetails()->get('id') }}<br />
                    {{ $data->getCustomerDetails()->get('phone') }}<br />
                    {{ $data->getCustomerDetails()->get('location') }}<br />
                    {{ $data->getCustomerDetails()->get('zip') }} {{ $data->getCustomerDetails()->get('city') }}
                    {{ $data->getCustomerDetails()->get('country') }}<br />
                </div>
            </div>
        </div>
    </div>
</div>

<br />

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
    @foreach ($data->getItems() as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->get('id') }}</td>
            <td>{{ $item->get('name') }}</td>
            <td>34.5</td>
            <td>56</td>
            <td>4555.9000</td>
        </tr>
    @endforeach
    </tbody>
</table>

<br /><br />
<div class="well">
    أصدرت كل من منظمة العفو الدولية وهيومن رايتس ووتش بيانا الثلاثاء عن التعذيب المزعوم للسجينات المحتجزات
</div>
</body>
</html>
