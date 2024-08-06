{{-- add katagri --}}
<div class="modal fade" id="addkeuangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Catatan Keuangan</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="addkeuangan" method="POST" id="modalForm">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputNominal3" class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="Number" class="form-control" id="inputNominal3" placeholder="Nominal"
                                    name="nominal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputjenis3" class="col-sm-2 col-form-label">jenis</label>
                            <div class="col-sm-10">
                                <select class="form-control select2 select2-hidden-accessible" name="jenis"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="pengeluaran">Pengeluaran</option>
                                    <option value="pemasumkan">Pemasukan</option>
                                </select>
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
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>


{{-- edit katagri --}}
<div class="modal fade" id="editdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Catatan</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" id="editmodals">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nominal" placeholder="Nominal"
                                    name="nominal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="jenis" id="jenis" style="width: 100%;">
                                    <option value="pengeluaran">Pengeluaran</option>
                                    <option value="pemasukan">Pemasukan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="deskripsi" placeholder="Deskripsi" name="deskripsi"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
