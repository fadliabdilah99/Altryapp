<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            margin: 0;
            padding: 0;
            color: #212529;
        }

        .invoice {
            padding: 30px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .invoice h4 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .invoice-info address {
            margin-bottom: 20px;
            font-style: normal;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .lead {
            font-size: 1.25rem;
            font-weight: 300;
            margin-bottom: 20px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .table .table {
            background-color: #fff;
        }

        .float-right {
            float: right;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="row clearfix">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Altry, Inc.
                    <small class="float-right">Date: {{ $invoicedetail->created_at }}</small>
                </h4>
            </div>
        </div>
        <div class="row clearfix invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>AltryManagemet.</strong><br>
                    CITI SQUARE BUSINESS PARK, Jl. Peta Selatan No.1 BLOK G, RT.10/RW.1, Kalideres,<br>
                    Kec. Kalideres, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11840<br>
                    Phone: +628984930404<br>
                    Email: contact@altryconsultinggroup.com
                </address>
            </div>
            <div class="col-sm-3 invoice-col">
                To
                <address>
                    <strong>{{ Auth::user()->name }}</strong><br>
                    {{ Auth::user()->address == null ? '-' : Auth::user()->address }}<br>
                    Phone: {{ Auth::user()->phone == null ? '-' : Auth::user()->phone }}<br>
                    Email: {{ Auth::user()->email }}
                </address>
            </div>
            <div class="col-sm-4 invoice-col text-right">
                <b>Invoice #{{ $id }}</b><br>
                <b>Account Id:</b> {{ Auth::user()->id }}
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product</th>
                            <th>QTY</th>
                            <th>Harga/prod</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->produk->nama }}</td>
                                <td>{{ $order->qty }}</td>
                                <td>Rp.{{ number_format($order->produk->harga) }}</td>
                                <td>Rp.{{ number_format($order->totalHarga) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-6">
                <p class="lead">Amount Due {{ $invoicedetail->tenggat }}</p>
            </div>
            <div class="col-6 text-right">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>Rp.{{ number_format($subtotal) }}</td>
                        </tr>
                        <tr>
                            <th>PPN (11%):</th>
                            <td>Rp.{{ number_format($ppn) }}</td>
                        </tr>
                        <tr>
                            <th>Administrasi:</th>
                            <td>Rp.{{ number_format($admin) }}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>Rp.{{ number_format($total) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
