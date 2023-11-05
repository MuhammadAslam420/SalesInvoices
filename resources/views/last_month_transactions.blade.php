<!DOCTYPE html>
<html>

<head>
    <title>How To Generate Invoice PDF In Laravel 9 - Techsolutionstuff</title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 200px;
        height: 60px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>
    <div class="head-title">
        <h1 class="text-center m-0 p-0">Payment Receipt Invoice</h1>
    </div>
    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100">{{ $setting->name }}</p>
            <p class="m-0 pt-5 text-bold w-100"> {{ $setting->address }}</p>
            <p class="m-0 pt-5 text-bold w-100">{{ $setting->email }}</p>
            <p class="m-0 pt-5 text-bold w-100">Contact: {{ $setting->phone }}</p>
        </div>
        <div class="w-50 float-left logo mt-10">

            <img src="https://techsolutionstuff.com/frontTheme/assets/img/logo_200_60_dark.png" alt="Logo">
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50">ReceiptID</th>
                <th class="w-50">CMID</th>
                <th class="w-50">Customer</th>
                <th class="w-50">Detail</th>
                <th class="w-50">Amount</th>
                <th class="w-50">PaymentMode</th>
                <th class="w-50">Date</th>
            </tr>

            @foreach($transactions as $transaction)
            <tr>
                <td>{{$transaction->id}}</td>
                <td>{{$transaction->sale->saleId}}</td>
                <td>{{$transaction->sale->customer->name}}</td>
                <td>{{$transaction->amount}}</td>
                <td>{{$transaction->ptype}}</td>
                <td>{{$transaction->detail}}</td>
                <td>{{$transaction->sale_date}}</td>
            </tr>
            @endforeach

            <tr>
                <td colspan="7">
                    <div class="total-part">
                        <div class="total-left w-85 float-left" align="right">

                            <p>Total Amount</p>
                        </div>
                        <div class="total-right w-15 float-left text-bold" align="right">

                            <p>{{ $transactions->sum('amount') }}</p>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</html>
