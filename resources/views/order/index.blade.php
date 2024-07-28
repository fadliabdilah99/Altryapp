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
    <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Produk <strong>{{ $name }}</strong>
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
                    <div class="row">
                        @foreach ($produks as $produk)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        {{ $produk->kategori->name }}
                                        @if ($produk->status == 'maintenance')
                                            <small class="btn btn-danger btn-sm">Maintenence</small>
                                        @endif
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{ $produk->nama }}</b></h2>
                                                <p class="text-muted text-sm"><b>{{ $produk->deskripsi }} </b></p>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="../../images/produk/{{ $produk->image }}" alt="user-avatar"
                                                    class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container" style="font-size: 20px; margin: 10px">
                                        <ul class="ml-4 mb-0 fa-ul text-muted">

                                            <li class="small"><span class="fa-li"><i class="bi bi-cash"></i></span>Rp
                                                {{ number_format($produk->harga, 0, ',', '.') }}</li>
                                            @if ($produk->kategori->jenis == 'sewa')
                                                <a href="{{ url('daftartanggal/' . $produk->id) }}"
                                                    class="btn btn-secondary btn-sm">Lihat Tanggal Kosong</a>
                                            @else
                                                <li class="small"><span class="fa-li"></span>Stok :
                                                    {{ $produk->stok }}
                                            @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="#" class="btn btn-sm bg-teal">
                                                <i class="fas fa-comments"></i>
                                            </a>
                                            @if ($produk->status == 'siap')
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    data-toggle="modal" data-target="#modal-cart{{ $produk->id }}">
                                                    <i class="bi bi-bag"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-primary maintenence">
                                                    <i class="bi bi-bag"></i>
                                                </button>
                                            @endif
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
                        @if (Auth::check())
                            <div class="row">
                                <span
                                    class="d-flex justify-content-center col-12 text-primary">{{ $cartsCount == 0 ? '' : $cartsCount }}</span>
                                <a href="{{ url('cart') }}" class="btn btn-primary"
                                    style="font-size: 1.5rem; border-radius: 50%;">
                                    <i class="bi bi-cart"></i></a>
                            </div>
                        @else
                            <div class="row">
                                <button class="btn btn-primary noLogin"
                                    style="font-size: 1.5rem; border-radius: 50%;"><i class="bi bi-cart"></i></button>
                            </div>
                        @endif
                    </div>
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

    @include('order.modal.prod')

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

    {{-- input nomor --}}
    <script>
        function increment(productId) {
            var numberInput = document.getElementById('number-' + productId);
            var currentValue = parseInt(numberInput.value);
            numberInput.value = currentValue + 1;

        }

        function decrement(productId) {
            var numberInput = document.getElementById('number-' + productId);
            var currentValue = parseInt(numberInput.value);
            var minValue = parseInt(numberInput.min);
            if (currentValue > minValue) {
                numberInput.value = currentValue - 1;
            }
        }
    </script>


    {{-- notifikasi --}}
    @if ($message = Session::get('success'))
        <script>
            $(document).ready(function() {
                toastr.success("{{ $message }}");
            });
        </script>
    @endif


    @if ($message = Session::get('error'))
        <script>
            $(document).ready(function() {
                toastr.error("{{ $message }}");
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

    {{-- alert no login --}}
    <script>
        $('.maintenence').click(function(e) {
            e.preventDefault()
            const data = $(this).closest('tr').find('td:eq(1)').text()
            Swal.fire({
                title: 'Mohon Maaf Produk Ini Sedang Dalam Maintenence',
                text: `Mungkin butuh waktu beberapa hari untuk maintenece!`,
                icon: 'warning',
                confirmButtonText: 'OK',
                focusConfirm: false
            })
        });
    </script>
</body>

</html>
