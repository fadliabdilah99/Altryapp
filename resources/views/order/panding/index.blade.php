<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    {{-- sweetalert --}}
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .fixed-button {
            position: fixed;
            right: 10px;
            bottom: 10px;
            padding: 10px 20px;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            z-index: 999;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Belum Di Bayar</strong>
                            <h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row d-flex justify-content-center">
                        @foreach ($invoices as $invoice)
                            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex text-center flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        @if ($invoice->status == 'pending')
                                            Produk Belum Di Bayar <span class="btn btn-sm btn-danger"></span>
                                        @else
                                            menunggu konfirmasi <span class="btn btn-sm btn-success"></span>
                                        @endif
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="">
                                            <div class="">
                                                <h2 class="lead"><b>Id Invoice {{ $invoice->idInvoice }}</b></h2>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <i class="bi bi-receipt-cutoff" style="font-size: 50px"></i>
                                        </div>
                                    </div>
                                    <div class="container" style="font-size: 20px; margin: 10px">
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="invoicePanding/{{ $invoice->idInvoice }}"
                                                class="btn btn-sm btn-primary" style="font-size: 20px">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="fixed-button">
                <div class="p-3">
                    <div class="col-12 py-1">
                        <div class="row">
                            <a href="" class="btn btn-success" style="font-size: 1.5rem; border-radius: 50%;"><i
                                    class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <p><i><b>*</b>Invoice Akan Kadaluarsa Setelah Jam 00:00, pastikan kamu segera membayarnya</i></p>
        <!-- /.content -->
    </div>


    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="../../plugins/toastr/toastr.min.js"></script>
    {{-- notifikasi --}}
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ $message }}",
                icon: "success"
            });
        </script>
    @endif

    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                title: "Errors!",
                text: "{{ $message }}",
                icon: "error"
            });
        </script>
    @endif



    {{-- alert no login --}}
    <script>
        $('.noLogin').click(function(e) {
            e.preventDefault()
            const data = $(this).closest('tr').find('td:eq(1)').text()
            Swal.fire({
                title: 'Anda Belum Login',
                text: `Mungkin beberapa fitur tidak bisa digunakan!`,
                icon: 'warning',
                confirmButtonText: 'OK',
                focusConfirm: false
            })
        });
    </script>
</body>

</html>
