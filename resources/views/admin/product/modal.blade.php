@foreach ($produks as $item)
    {{-- edit produk --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Produk</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ url("editproduk/$item->id") }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputnama3" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $item->nama }}" class="form-control"
                                        id="inputnama3" placeholder="nama" name="name">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Edit</button>
                            <button type="submit" class="btn btn-default float-right">Cancel</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


{{-- add ptoduk --}}
<div class="modal fade" id="addproduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Add Produk</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="addproduk" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="exampleInputEmail1">Nama Produk</label>
                            <input type="text" class="form-control" name="nama" id="exampleInputEmail1"
                                placeholder="Nama">
                        </div>
                        <div class="col-6 form-group">
                            <label for="exampleInputEmail1">Kategori Produk</label>
                            <select class="form-control select2 select2-hidden-accessible" name="kategori_id"
                                style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 form-group">
                            <label for="exampleInputEmail1">Stok</label>
                            <input type="text" class="form-control" name="stok" id="exampleInputEmail1"
                                placeholder="Stok">
                        </div>
                        <div class="col-3 form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="Number" class="form-control" name="harga" id="exampleInputEmail1"
                                placeholder="Harga">
                        </div>
                        <div class="col6">
                            <label for="exampleInputEmail1">Foto Produk</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <label>Textarea</label>
                            <textarea class="form-control" rows="3" name="deskripsi" placeholder="Enter ..."></textarea>
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
