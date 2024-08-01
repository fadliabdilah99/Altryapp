@extends('template.main')

@section('title', 'order')

@push('style')
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="ns/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="ns/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="ns/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">home</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>





    <!-- paid table box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <h3>Status paid</h3>
        </div>

        <div class="card-body">
            <table id="paid1" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Produk</th>
                        <th>status</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paid as $order)
                        <tr>
                            <td>{{ $order->idInvoice }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <a href="{{ url("invoicePanding/$order->idInvoice") }}" class="btn btn-secondary"><i
                                        class="bi bi-eye"></i></a>
                            </td>
                            <td>
                                <div class="row d-flex justify-content-center">
                                    <form action="{{ url('invoice-confirm') }}" method="POST">
                                        @csrf
                                        <input type="number" name="id" value="{{ $order->idInvoice }}" hidden>
                                        <button class="btn btn-success mx-1 delete-data">Konfirmasi</button>
                                    </form>

                                    <form action="{{ url('order-delete') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="number" name="id" value="{{ $order->idInvoice }}" hidden>
                                        <button class="btn bg-danger  delete-data" type="button">
                                            Tolak</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>


    <!-- pending table box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <h3>Status pending</h3>
        </div>

        <div class="card-body">
            <table id="pending1" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Produk</th>
                        <th>status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pending as $order)
                        <tr>
                            <td>{{ $order->idInvoice }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <a href="{{ url("invoicePanding/$order->idInvoice") }}" class="btn btn-secondary"><i
                                        class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>


    @include('admin.order.modal')
@endsection
{{-- content --}}

@push('script')
    {{-- sweetalert2 --}}
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#paid1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#paid1_wrapper .col-md-6:eq(0)');
            $('#paid2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $(function() {
            $("#pending1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#pending1_wrapper .col-md-6:eq(0)');
            $('#pending2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        // script delete start
        $('.delete-data').click(function(e) {
            e.preventDefault()
            const data = $(this).closest('tr').find('td:eq(0)').text()
            Swal.fire({
                    title: 'data akan di tolak',
                    text: `Apakah data ${data} akan di tolak?`,
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
@endpush
