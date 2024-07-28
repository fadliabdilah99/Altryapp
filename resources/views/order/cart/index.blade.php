<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    {{-- sweetalert --}}
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="../../index3.html" class="navbar-brand">
                    <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item">Some action </a></li>
                                <li><a href="#" class="dropdown-item">Some other action</a></li>

                                <li class="dropdown-divider"></li>

                                <!-- Level two dropdown-->
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">Hover for action</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                        </li>

                                        <!-- Level three dropdown-->
                                        <li class="dropdown-submenu">
                                            <a id="dropdownSubMenu3" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                class="dropdown-item dropdown-toggle">level 2</a>
                                            <ul aria-labelledby="dropdownSubMenu3"
                                                class="dropdown-menu border-0 shadow">
                                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                            </ul>
                                        </li>
                                        <!-- End Level three -->

                                        <li><a href="#" class="dropdown-item">level 2</a></li>
                                        <li><a href="#" class="dropdown-item">level 2</a></li>
                                    </ul>
                                </li>
                                <!-- End Level two -->
                            </ul>
                        </li>
                    </ul>

                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-0 ml-md-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-comments"></i>
                            <span class="badge badge-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar"
                                        class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                            role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-bottom: 5%">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><span>Keranjang</span></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Keranjang</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <form id="checkoutForm" action="{{ url('checkout') }}" method="POST">
                        @csrf
                        @foreach ($carts as $cart)
                        <div class="timeline-item border-bottom p-2">
                                <div class="form-check d-flex">
                                    <input type="checkbox" class="form-check-input " name="cart_ids[]"
                                        value="{{ $cart->id }}" id="cartCheck{{ $cart->id }}"
                                        onclick="toggleItem({{ $cart->id }})">
                                    <label class="form-check-label" for="cartCheck{{ $cart->id }}">pilih</label>
                                </div>
                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <img src="{{ asset('images/produk/' . $cart->produk->image) }}"
                                            class="rounded-circle" width="100px" alt="">
                                    </div>
                                    <div class="col-10 d-flex justify-content-around align-items-center">
                                        <div>
                                            <h3>{{ $cart->produk->nama }}</h3>
                                            <p>Rp.{{ number_format($cart->produk->harga, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="row number-input">
                                            <button class="col-4 btn btn-primary btn-sm" type="button"
                                                onclick="decrement({{ $cart->id }})">-</button>
                                            <input class="col-4 btn btn-default btn-sm"
                                                id="number-{{ $cart->id }}" name="qty[{{ $cart->id }}]"
                                                type="number" min="0" value="{{ $cart->qty }}">
                                            <button class="col-4 btn btn-primary btn-sm" type="button"
                                                onclick="increment({{ $cart->id }})">+</button>
                                            @if ($cart->produk->kategori->jenis == 'jual')
                                                <p>/unit</p>
                                            @else
                                                <p>/hari</p>
                                            @endif
                                        </div>
                                        <div class="form-group row"> 
                                            @if ($cart->produk->kategori->jenis == 'sewa')
                                                <label for="inputtime3" class="col-sm-5 col-form-label">Dari
                                                    Tanggal</label>
                                                <div class="col-sm-7">
                                                    <input type="date" name="dari_tgl[{{ $cart->id }}]"
                                                        class="form-control" id="inputtime3" placeholder="time"
                                                        required>
                                                </div>
                                                <a href="daftartanggal/{{ $cart->produk->id }}" class="btn btn-sm btn-primary">Lihat Tanggal Kosong</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="produk_id[{{ $cart->id }}]"
                                    value="{{ $cart->produk->id }}">
                                <input type="hidden" name="price[{{ $cart->id }}]"
                                    value="{{ $cart->produk->harga }}">
                            </div>
                        @endforeach

                    </form>
                </div>
            </div>
            <div class="fixed-bottom bg-secondary p-3 d-flex align-items-center justify-content-between px-5">
                <div class="form-check d-flex fs-2">
                    <input type="checkbox" class="form-check-input" id="selectAll" onclick="toggleSelectAll()">
                    <label class="form-check-label" for="selectAll">pilih semua</label>
                </div>
                <div class="align-items-center">
                    <h5>Total harga : <span id="totalPrice">0</span></h5>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('checkoutForm').submit();">Checkout</button>
                </div>
            </div>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="plugins/sweetalert2/sweetalert2.min.js"></script>


        {{-- select function --}}
        <script>
            function toggleSelectAll() {
                var selectAllCheckbox = document.getElementById('selectAll');
                var checkboxes = document.querySelectorAll('input[name="cart_ids[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                    toggleItem(checkbox.value);
                });
                updateTotalPrice();
            }

            function toggleItem(id) {
                const qtyInput = document.getElementById(`number-${id}`);
                const checkBox = document.getElementById(`cartCheck${id}`);
                qtyInput.disabled = !checkBox.checked;
                updateTotalPrice();
            }

            function updateTotalPrice() {
                let total = 0;
                const checkboxes = document.querySelectorAll('input[name="cart_ids[]"]:checked');
                checkboxes.forEach(checkbox => {
                    const id = checkbox.value;
                    const qty = document.getElementById(`number-${id}`).value;
                    const price = document.querySelector(`input[name="price[${id}]"]`).value;
                    total += qty * price;
                });
                document.getElementById('totalPrice').innerText = total.toLocaleString('id-ID');
            }
        </script>

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
</body>

</html>
