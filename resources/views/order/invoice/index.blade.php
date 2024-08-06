<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Invoice</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    {{-- sweetalert --}}
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Invoice</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

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
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Product</th>
                                                    <th>QTY</th>
                                                    <th>Masa Sewa</th>
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
                                                        <td>{{ $order->dari_tgl }} - {{ $order->sampai_tgl }}</td>
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
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        @if ($invoicedetail->status == 'proses' || $invoicedetail->status == 'selesai')
                                            <h1 class="text-success">LUNAS</h1>
                                            <p>Altry group management</p>
                                        @elseif($invoicedetail->status == 'tolak')
                                            <h1 class="text-danger">DITOLAK</h1>
                                            <p>Altry group management</p>
                                        @elseif($invoicedetail->status == 'refund')
                                            <h1 class="text-warning">REFUND</h1>
                                            <p>Altry group management</p>
                                        @endif
                                        <a href="{{ url('invoice-print/' . $id) }}" rel="noopener" target="_blank"
                                            class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                        @if ($invoicedetail->status == 'pending' && Auth::user()->role == 'user')
                                            <div class="row float-right mx-1">

                                                <button type="button" class="btn mx-1 btn-success float-right"
                                                    data-toggle="modal" data-target="#modal-manual">Transfer
                                                </button>


                                                {{-- payment otomatis --}}
                                                <form action="#" id="payment_form">
                                                    <div class="" hidden>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">idInvoice</label>
                                                                    <input type="text" name="invoice_code"
                                                                        class="form-control" id="invoice_code"
                                                                        value="{{ $invoicedetail->idInvoice }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Id</label>
                                                                    <input type="Number" name="user_id"
                                                                        class="form-control" id="user_id"
                                                                        value="{{ $invoicedetail->user_id }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Nama</label>
                                                                    <input type="text" name="email"
                                                                        class="form-control" id="email"
                                                                        value="{{ $invoicedetail->user->email }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Jenis Donasi</label>
                                                                    <input type="text" name="type"
                                                                        class="form-control" id="type"
                                                                        value="pembayaran undangan {{ $invoicedetail->idInvoice }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Jumlah</label>
                                                                    <input type="number" name="amount"
                                                                        class="form-control" id="amount"
                                                                        value="{{ $total }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Catatan (Opsional)</label>
                                                                    <textarea name="note" cols="30" rows="3" class="form-control" id="note"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <button class="btn btn-success float-right"
                                                        type="submit">Payment</button>
                                                </form>
                                                {{-- end payment --}}
                                            </div>
                                        @elseif($invoicedetail->status == 'paid' && Auth::user()->role == 'admin')
                                            <form action="{{ url('invoice-confirm') }}" method="POST">
                                                @csrf
                                                <input type="number" name="id" value="{{ $id }}"
                                                    hidden>
                                                <button class="btn btn-success float-right mx-1">Konfirmasi</button>
                                            </form>

                                            <form action="{{ url('order-delete') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="number" name="id" value="{{ $id }}"
                                                    hidden>
                                                <button class="btn bg-danger float-right" type="submit">
                                                    Tolak</button>
                                            </form>



                                            <button type="button" class="btn btn-success float-right mx-1"
                                                data-toggle="modal" data-target="#modal-foto">Bukti Bayar</button>
                                        @endif
                                        <a href="{{ url('invoice/' . $id) }}"
                                            class="btn btn-primary float-right mx-1">
                                            <i class="fas fa-download"></i> Generate PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->




        {{-- include modal --}}
        @include('order.modal.pay')



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>



    <script>
        // Payment Midtrans function
        $("#payment_form").submit(function(event) {
            event.preventDefault();

            $.post("/api/payment", {
                        _method: 'POST',
                        _token: '{{ csrf_token() }}',
                        invoice_code: $('input#invoice_code').val(),
                        user_id: $('input#user_id').val(),
                        email: $('input#email').val(),
                        type: $('input#type').val(),
                        amount: $('input#amount').val(),
                        note: $('textarea#note').val(),
                    },
                    function(data, status) {
                        if (data.status === 'error') {
                            alert(data.message);
                        } else {
                            console.log(data);
                            snap.pay(data.snap_token, {
                                // Optional
                                onSuccess: function(result) {
                                    console.log('success');
                                    console.log(result);
                                    location.reload();
                                },
                                // Optional
                                onPending: function(result) {
                                    console.log('pending');
                                    console.log(result);
                                    location.reload();
                                },
                                // Optional
                                onError: function(result) {
                                    console.log('error');
                                    console.log(result);
                                    location.reload();
                                }
                            });
                        }
                        return false;
                    })
                .fail(function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        });
    </script>



    {{-- fungsi copy --}}
    <script>
        function copyText(elementId) {
            // Buat elemen input sementara untuk menampung teks
            var tempInput = document.createElement("input");
            // Dapatkan teks dari elemen dengan id yang diberikan
            var textToCopy = document.getElementById(elementId).innerText;
            // Masukkan teks ke dalam elemen input
            tempInput.value = textToCopy;
            // Tambahkan elemen input ke dalam body
            document.body.appendChild(tempInput);
            // Pilih teks dalam elemen input
            tempInput.select();
            // Salin teks yang dipilih ke clipboard
            document.execCommand("copy");
            // Hapus elemen input sementara dari body
            document.body.removeChild(tempInput);
        }


        // notifikasi
        $('.success-copy').click(function(e) {
            e.preventDefault();
            const data = $(this).closest('.featurette').find('h2').text();
            Swal.fire({
                title: 'Success!',
                text: `Tersalin.`,
                icon: 'success',
                confirmButtonText: 'OK',
                focusConfirm: false
            });
        });
    </script>
</body>

</html>
