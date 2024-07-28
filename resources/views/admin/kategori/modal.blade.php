@foreach ($kategoris as $item)
    {{-- edit user --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Users</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ url("editkategori/$item->id") }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputnama3" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $item->name }}" class="form-control"
                                        id="inputnama3" placeholder="nama" name="name">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Edit</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>




    {{-- Terkaitt --}}
    <div class="modal fade" id="terkait{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Produk</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        @if ($item->produk->isEmpty())
                            <p>No products</p>
                        @endif
                        @foreach ($item->produk as $prod)
                            <div class="card border border-light col-3 mx-1" style="width: 18rem;">
                                <img src="images/produk/{{ $prod->image }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-text">{{ $prod->nama }}</h6>
                                    <p class="card-text">{{ $prod->harga }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


{{-- add katagri --}}
<div class="modal fade" id="addkategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Add kategori</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="addkategori" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputkategori3" class="col-sm-2 col-form-label">kategori</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputkategori3" placeholder="kategori"
                                    name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <label for="inputfoto3" class="col-sm-2 col-form-label">foto</label>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputdeskripsi3" class="col-sm-2 col-form-label">deskripsi</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="inputdeskripsi3" placeholder="deskripsi" name="deskripsi"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Tambah</button>
                        <button type="submit" class="btn btn-default float-right">Cancel</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
