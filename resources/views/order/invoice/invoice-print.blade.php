<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Invoice Print</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <div class="container">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> Altry, Inc.
                                            <small class="float-right">Date: {{ $invoicedetail->created_at }}</small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        From
                                        <address>
                                            <strong>AltryManagemet.</strong><br>
                                            CITI SQUARE BUSINESS PARK, Jl. Peta Selatan No.1 BLOK G, RT.10/RW.1,
                                            Kalideres, <br>
                                            Kec. Kalideres, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11840<br>
                                            Phone: +628984930404<br>
                                            Email: contact@altryconsultinggroup.com
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 invoice-col">
                                        To
                                        <address>
                                            <strong>{{ Auth::user()->name }}</strong><br>
                                            {{ Auth::user()->address == null ? '-' : Auth::user()->address }}<br>
                                            Phone: {{ Auth::user()->phone == null ? '-' : Auth::user()->phone }}<br>
                                            Email: {{ Auth::user()->email }}
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Invoice #{{ $id }}</b><br>
                                        <b>Account Id:</b> {{ Auth::user()->id }}
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
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
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row d-flex justify-content-between">
                                    <!-- accepted payments column -->
                                    <div class="col-5 border">
                                        <p class="lead">Syarat dan ketentuan:</p>
                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            Dengan ini saya menyetujui bahwa, pihak altry berhak untuk melakukan
                                            pembatalan barang yang telah disewa/dibeli secara sepihak, dengan
                                            mendapatkan
                                            ganti rugi sebesar 110% dari total pembayaran, ditambah dengan unit
                                            pengganti (jika barang sewa). Apabila penyewa atau pembeli membatalkan
                                            pesanan, maka pengembalian uang yang akan diterima adalah sebesar 90% dari
                                            total pembayaran.
                                        </p>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <p class="lead">Amount Due {{ $invoicedetail->tenggat }}</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal: </th>
                                                    <td>Rp.{{ number_format($subtotal) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>PPN (11%)</th>
                                                    <td>Rp.{{ number_format($ppn) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Administrasi:</th>
                                                    <td>Rp {{ number_format($admin) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>{{ number_format($total) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">

                                        @if ($invoicedetail->status == 'proses' || $invoicedetail->status == 'selesai')
                                            <h1 class="text-success col-12">LUNAS</h1>
                                            <p>Altry group management</p>
                                        @elseif($invoicedetail->status == 'tolak')
                                            <h1 class="col-12 text-danger">DITOLAK</h1>
                                            <p>Altry group management</p>
                                        @elseif($invoicedetail->status == 'refund')
                                            <h1 class="text-warning col-12">REFUND</h1>
                                            <p>Altry group management</p>
                                        @endif
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
