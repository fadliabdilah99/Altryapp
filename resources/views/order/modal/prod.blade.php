@foreach ($produks as $item)
    <div class="modal fade" id="modal-cart{{ $item->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Masukan Keranjang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="content">

                        <!-- Default box -->
                        <div class="card card-solid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="col-12">
                                            <img src="../../images/produk/{{ $item->image }}" class="product-image"
                                                alt="Product Image">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h3 class="my-3">{{ $item->nama }}</h3>
                                        <p>{{ $item->deskripsi }}</p>

                                        <hr>
                                        <div class="bg-gray py-2 px-3 mt-4">
                                            <h2 class="mb-0">
                                                {{ number_format($item->harga, 0, ',', '.') }}
                                            </h2>
                                            <h4 class="mt-0">
                                                <small>/items</small>
                                            </h4>
                                        </div>

                                        <form class="mt-4" action="{{url('addcart')}}" method="POST">
                                            @csrf
                                            <input type="text" name="produk_id" value="{{ $item->id }}" hidden>
                                            <input type="text" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '0' }}" hidden>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row number-input">
                                                        <button class="col-4 btn btn-secondary" type="button" onclick="decrement({{ $item->id }})">-</button>
                                                        <input class="col-4 btn btn-default" id="number-{{ $item->id }}" name="qty" type="number" value="0" min="0">
                                                        <button class="col-4 btn btn-secondary" type="button" onclick="increment({{ $item->id }})">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="">
                                                        @if (Auth::check())    
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-cart-plus fa-lg"></i>
                                                        </button>
                                                        @else
                                                        <button type="button" class="btn btn-primary noLogin">
                                                            <i class="fas fa-cart-plus fa-lg"></i>
                                                        </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <nav class="w-100">
                                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="product-comments-tab"
                                                data-toggle="tab" href="#product-comments" role="tab"
                                                aria-controls="product-comments" aria-selected="false">Comments</a>
                                            <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab"
                                                href="#product-rating" role="tab" aria-controls="product-rating"
                                                aria-selected="false">Rating</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="product-comments" role="tabpanel"
                                            aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis
                                            luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse
                                            potenti.
                                            Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat
                                            orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac,
                                            consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget
                                            porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex
                                            elit
                                            euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem,
                                            dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at
                                            magna
                                            elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit
                                            vel,
                                            tincidunt ipsum. </div>
                                        <div class="tab-pane fade" id="product-rating" role="tabpanel"
                                            aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum
                                            non,
                                            posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue,
                                            id
                                            fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent
                                            vel
                                            ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula
                                            euismod
                                            neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula,
                                            aliquet
                                            feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac
                                            molestie
                                            lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at,
                                            consectetur nec justo. Quisque suscipit odio velit, at accumsan urna
                                            vestibulum
                                            a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at
                                            mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo
                                            ullamcorper. Donec varius massa at semper posuere. Integer finibus orci
                                            vitae
                                            vehicula placerat. </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endforeach
