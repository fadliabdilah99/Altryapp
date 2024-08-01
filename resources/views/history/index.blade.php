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
                        <h4>History</strong>
                            <h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Selesai</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($historys as $item)
                            <div class="col-12 col-md-6 text-center">
                                <!-- Default box -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $item->status }}</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row" style="text-align: center">
                                            <h4>{{ $item->idInvoice }}</h4>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer d-flex justify-content-center">
                                        <a href="{{ url('invoice-history/' . $item->idInvoice) }}"
                                            class="btn btn-success btn-sm">Info</a>
                                        @if ($item->status == 'proses' && $item->dari_tgl > date('Y-m-d'))
                                            <form action="{{ url('refund/2') }}" method="POST">
                                                @csrf
                                                <input type="number" name="id" value="{{ $item->idInvoice }}"
                                                    hidden>
                                                <button class="btn btn-warning btn-sm ml-1 refund-data"
                                                    type="submit">Refund</button>
                                            </form>
                                        @endif
                                    </div>
                                    <!-- /.card-footer-->
                                </div>
                                <!-- /.card -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
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
        $('.refund-data').click(function(e) {
            e.preventDefault()
            const data = $(this).closest('tr').find('td:eq(1)').text()
            Swal.fire({
                    title: 'data akan di refund',
                    text: `Apakah data ${data} refund dilanjutkan?`,
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonText: 'Ya',
                    denyButtonText: 'Tidak',
                    focusConfirm: false
                })
                .then((result) => {
                    if (result.isConfirmed) $(e.target).closest('form').submit()
                    else swal.close()
                })
        });
    </script>



</body>

</html>
