<!DOCTYPE HTML>
<!--
 Helios by HTML5 UP
 html5up.net | @ajlkn
 Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>Helios by HTML5 UP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="assets-home/css/main.css" />
    {{-- sweetalert --}}
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
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

        .content {
            padding-right: 150px;
        }
    </style>
</head>

<body class="homepage is-preload">
    <div id="page-wrapper">

        <!-- Header -->
        <div id="header" id="header">

            <!-- Inner -->
            <div class="inner">
                <header>
                    <div class="typing-container">
                        <span id="typing-text" class="fs-1 fw-bold"></span>
                        <h1 class="cursor">.
                        </h1>
                        <div id="text-data"
                            data-texts='[
                            @if (Auth::check()) "Hallo {{ Auth::user()->name }}",
                            @else
                            "Yuk Buat Akun", @endif
                            "Altry Consulting Group"]'
                            style="display: none;">
                        </div>
                    </div>
                    <hr />
                    <p>Bisnis Konsultan & Marketing Agency</p>
                </header>
                <footer>
                    <a href="#about" class="button circled ">Start</a>
                </footer>
            </div>

            <!-- Nav -->
            <nav id="nav">
                <ul>
                    <li><a href="#header">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#produk">Produk</a></li>
                    @if (Auth::check())
                        <li><a href="logout">Logout</a></li>
                    @else
                        <li><a href="login">Login</a></li>
                        <li><a href="register">Register</a></li>
                    @endif
                </ul>
            </nav>

        </div>


        <!-- Main -->
        <div class="wrapper style2" id="about">
            <article id="main" class="container special text-center mt-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <h2 style="color: #ef8376">About Us</h2>
                    <div class="col-7 col-sm-12">
                        <h2><a href="#">Kami Menumbuhkan Profit</a></h2>
                        <p>
                            Tidak hanya memberikan solusi tetapi juga membuat strategi, planning hingga evaluasi terbaik
                            untuk dapat terus meningkatkan profit bisnis Anda.
                            Kami pun terus berkomitmen hingga terjalin hubungan baik dalam berbisnis karena bisnis
                            dimulai dari saling percaya dengan tujuan yang tepat. <br>
                        </p>
                        <footer>
                            <a href="#" class="button">Continue Reading</a>
                        </footer>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <img src="images/about.png" alt="" class="img-fluid">
                    </div>
                </div>
            </article>

        </div>

        {{-- product --}}
        <main id="produk">
            <!-- Banner -->
            <section id="banner">
                <h1>LAYANAN KAMI</h1>
                <header>
                    <h2>Layanan Dan Produk <strong>Altry</strong> Group</h2>
                    <p>
                        Layanan kami akan membantu bisnis Anda mendapatkan jalan keluar dan solusi yang tepat.
                    </p>
                </header>
                <div class="d-flex justify-content-evenly fs-1 p-3 border mx-5 rounded-5">
                    <a {{ Auth::check() ? 'href=cart' : 'class=noLogin' }}>
                        <span
                            class="d-flex justify-content-center col-12 text-primary fs-5 ps-4">{{ $cartsCount == 0 ? '-' : $cartsCount }}</span>
                        <i class="bi bi-cart"></i>
                        <p class="fs-6 fw-bold">Keranjang</p>
                    </a>
                    <a {{ Auth::check() ? 'href=panding' : 'class=noLogin' }}>
                        <span
                            class="d-flex justify-content-center col-12 text-primary fs-5 ps-4">{{ $invoicesCount == 0 ? '-' : $invoicesCount }}</span>
                        <i class="bi bi-wallet2"></i>
                        <p class="fs-6 fw-bold">Belum Bayar</p>
                    </a>
                    <a {{ Auth::check() ? 'href=history' : 'class=noLogin' }}>
                        <span
                            class="d-flex justify-content-center col-12 text-primary fs-5 ps-4">{{ $doneOrder == 0 ? '-' : $doneOrder }}</span>
                        <i class="bi bi-check-all"></i>
                        <p class="fs-6 fw-bold">Selesai</p>
                    </a>
                </div>
            </section>

            <!-- Carousel -->
            <section class="carousel">
                <div class="reel">
                    @foreach ($kategoris as $kategori)
                        <article>
                            <a href="#" class="image featured d-flex justify-content-center"><img class="mt-3"
                                    src="images/kategori/{{ $kategori->image }}" style="width: 150px"
                                    alt="" /></a>
                            <header>
                                <h3>{{ $kategori->name }}</h3>
                            </header>
                            <p>{{ $kategori->deskripsi }}.</p>
                            <a href="order/{{ $kategori->id }}" class="btn btn-primary">Buy Now <i
                                    class="fas fa-arrow-right"></i></a>
                        </article>
                    @endforeach
                </div>
            </section>
        </main>

        <!-- Features -->
        <div class="wrapper style1">

            <section id="features" class="container special">
                <header>
                    <h2>Morbi ullamcorper et varius leo lacus</h2>
                    <p>Ipsum volutpat consectetur orci metus consequat imperdiet duis integer semper magna.</p>
                </header>
                <div class="row">
                    <article class="col-4 col-12-mobile special">
                        <a href="#" class="image featured"><img src="images/pic07.jpg" alt="" /></a>
                        <header>
                            <h3><a href="#">Gravida aliquam penatibus</a></h3>
                        </header>
                        <p>
                            Amet nullam fringilla nibh nulla convallis tique ante proin sociis accumsan lobortis. Auctor
                            etiam
                            porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat
                            integer interdum.
                        </p>
                    </article>
                    <article class="col-4 col-12-mobile special">
                        <a href="#" class="image featured"><img src="images/pic08.jpg" alt="" /></a>
                        <header>
                            <h3><a href="#">Sed quis rhoncus placerat</a></h3>
                        </header>
                        <p>
                            Amet nullam fringilla nibh nulla convallis tique ante proin sociis accumsan lobortis. Auctor
                            etiam
                            porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat
                            integer interdum.
                        </p>
                    </article>
                    <article class="col-4 col-12-mobile special">
                        <a href="#" class="image featured"><img src="images/pic09.jpg" alt="" /></a>
                        <header>
                            <h3><a href="#">Magna laoreet et aliquam</a></h3>
                        </header>
                        <p>
                            Amet nullam fringilla nibh nulla convallis tique ante proin sociis accumsan lobortis. Auctor
                            etiam
                            porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat
                            integer interdum.
                        </p>
                    </article>
                </div>
            </section>

        </div>

        <!-- Footer -->
        <div id="footer">
            <div class="container">
                <div class="row">

                    <!-- Tweets -->
                    <section class="col-4 col-12-mobile">
                        <header>
                            <h2 class="icon brands fa-twitter circled"><span class="label">Tweets</span></h2>
                        </header>
                        <ul class="divided">
                            <li>
                                <article class="tweet">
                                    Amet nullam fringilla nibh nulla convallis tique ante sociis accumsan.
                                    <span class="timestamp">5 minutes ago</span>
                                </article>
                            </li>
                            <li>
                                <article class="tweet">
                                    Hendrerit rutrum quisque.
                                    <span class="timestamp">30 minutes ago</span>
                                </article>
                            </li>
                            <li>
                                <article class="tweet">
                                    Curabitur donec nulla massa laoreet nibh. Lorem praesent montes.
                                    <span class="timestamp">3 hours ago</span>
                                </article>
                            </li>
                            <li>
                                <article class="tweet">
                                    Lacus natoque cras rhoncus curae dignissim ultricies. Convallis orci aliquet.
                                    <span class="timestamp">5 hours ago</span>
                                </article>
                            </li>
                        </ul>
                    </section>

                    <!-- Posts -->
                    <section class="col-4 col-12-mobile">
                        <header>
                            <h2 class="icon solid fa-file circled"><span class="label">Posts</span></h2>
                        </header>
                        <ul class="divided">
                            <li>
                                <article class="post stub">
                                    <header>
                                        <h3><a href="#">Nisl fermentum integer</a></h3>
                                    </header>
                                    <span class="timestamp">3 hours ago</span>
                                </article>
                            </li>
                            <li>
                                <article class="post stub">
                                    <header>
                                        <h3><a href="#">Phasellus portitor lorem</a></h3>
                                    </header>
                                    <span class="timestamp">6 hours ago</span>
                                </article>
                            </li>
                            <li>
                                <article class="post stub">
                                    <header>
                                        <h3><a href="#">Magna tempus consequat</a></h3>
                                    </header>
                                    <span class="timestamp">Yesterday</span>
                                </article>
                            </li>
                            <li>
                                <article class="post stub">
                                    <header>
                                        <h3><a href="#">Feugiat lorem ipsum</a></h3>
                                    </header>
                                    <span class="timestamp">2 days ago</span>
                                </article>
                            </li>
                        </ul>
                    </section>

                    <!-- Photos -->
                    <section class="col-4 col-12-mobile">
                        <header>
                            <h2 class="icon solid fa-camera circled"><span class="label">Photos</span></h2>
                        </header>
                        <div class="row gtr-25">
                            <div class="col-6">
                                <a href="#" class="image fit"><img src="images/pic10.jpg"
                                        alt="" /></a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="image fit"><img src="images/pic11.jpg"
                                        alt="" /></a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="image fit"><img src="images/pic12.jpg"
                                        alt="" /></a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="image fit"><img src="images/pic13.jpg"
                                        alt="" /></a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="image fit"><img src="images/pic14.jpg"
                                        alt="" /></a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="image fit"><img src="images/pic15.jpg"
                                        alt="" /></a>
                            </div>
                        </div>
                    </section>

                </div>
                <hr />
                <div class="row">
                    <div class="col-12">

                        <!-- Contact -->
                        <section class="contact">
                            <header>
                                <h3>Nisl turpis nascetur interdum?</h3>
                            </header>
                            <p>Urna nisl non quis interdum mus ornare ridiculus egestas ridiculus lobortis vivamus
                                tempor aliquet.</p>
                            <ul class="icons">
                                <li><a href="#" class="icon brands fa-twitter"><span
                                            class="label">Twitter</span></a></li>
                                <li><a href="#" class="icon brands fa-facebook-f"><span
                                            class="label">Facebook</span></a></li>
                                <li><a href="#" class="icon brands fa-instagram"><span
                                            class="label">Instagram</span></a></li>
                                <li><a href="#" class="icon brands fa-pinterest"><span
                                            class="label">Pinterest</span></a></li>
                                <li><a href="#" class="icon brands fa-dribbble"><span
                                            class="label">Dribbble</span></a></li>
                                <li><a href="#" class="icon brands fa-linkedin-in"><span
                                            class="label">Linkedin</span></a></li>
                            </ul>
                        </section>

                        <!-- Copyright -->
                        <div class="copyright">
                            <ul class="menu">
                                <li>&copy; Untitled. All rights reserved.</li>
                                <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- whatsaap --}}
    </div>
    <div class="fixed-button">
        <div class="p-3">
            <div class="col-12 py-1">
                @if (Auth::check())
                    <a href="" class="btn btn-primary" style="font-size: 1.5rem; border-radius: 50%;"><i
                            class="bi bi-envelope"></i></a>
                @else
                    <button class="noLogin btn btn-primary" style="font-size: 1.5rem; border-radius: 50%;"><i
                            class="bi bi-envelope"></i></button>
                @endif
            </div>
            <div class="col-12 py-1">
                <a href="" class="btn btn-success" style="font-size: 1.5rem; border-radius: 50%;"><i
                        class="bi bi-whatsapp"></i></a>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="assets-home/js/jquery.min.js"></script>
    <script src="assets-home/js/jquery.dropotron.min.js"></script>
    <script src="assets-home/js/jquery.scrolly.min.js"></script>
    <script src="assets-home/js/jquery.scrollex.min.js"></script>
    <script src="assets-home/js/browser.min.js"></script>
    <script src="assets-home/js/breakpoints.min.js"></script>
    <script src="assets-home/js/util.js"></script>
    <script src="assets-home/js/main.js"></script>
    <!-- SweetAlert2 -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>


    {{-- typing script --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const textDataElement = document.getElementById("text-data");
            const texts = JSON.parse(textDataElement.getAttribute("data-texts"));

            let currentTextIndex = 0;
            let charIndex = 0;
            const typingSpeed = 150;
            const erasingSpeed = 100;
            const newTextDelay = 2000; // Delay between current and next text

            const typingTextSpan = document.getElementById("typing-text");

            function type() {
                if (charIndex < texts[currentTextIndex].length) {
                    typingTextSpan.textContent += texts[currentTextIndex].charAt(charIndex);
                    charIndex++;
                    setTimeout(type, typingSpeed);
                } else {
                    setTimeout(erase, newTextDelay);
                }
            }

            function erase() {
                if (charIndex > 0) {
                    typingTextSpan.textContent = texts[currentTextIndex].substring(0, charIndex - 1);
                    charIndex--;
                    setTimeout(erase, erasingSpeed);
                } else {
                    currentTextIndex = (currentTextIndex + 1) % texts.length;
                    setTimeout(type, typingSpeed + 1100);
                }
            }

            setTimeout(type, newTextDelay);
        });
    </script>

    {{-- no login --}}
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
