    <div class="modal fade" id="modal-manual">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Transfer Paynent</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="content">
                        <h5>Tagihan : <b>Rp.{{ number_format($total) }}</b></h5>
                        <div class="row py-3">
                            <div class="col-6 text-center">
                                <div class="border">
                                    <h4 class="text-primary"><b>BCA</b></h4>
                                    <p>1234567890</p>
                                    <p hidden id="copy-1">1234567890</p>
                                    <button type="submit" class="btn btn-info mb-2 success-copy"
                                        onclick="copyText('copy-1')">Copy</button>
                                </div>
                            </div>
                            <div class="col-6 text-center">
                                <div class="border">
                                    <h4 class="text-primary"><b>BRI</b></h4>
                                    <p>0987654321</p>
                                    <p hidden id="copy-2">0987654321</p>
                                    <button type="submit" class="btn btn-info mb-2 success-copy"
                                        onclick="copyText('copy-2')">Copy</button>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <form action="{{ url('pay/' . $id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="noHP">No-Wa untuk notifikasi <i>(opsional)</i></label>
                                        <input type="Number" name="noHP" class="form-control" id="noHP"
                                            placeholder="08..">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="foto"
                                                    id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    <div class="modal fade" id="modal-foto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bukti Transfer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                 <section class="content">
                    @if (!empty($pay->foto))
                    <img src="{{ asset('images/payment/' . $pay->foto) }}" class="img-fluid" alt="">
                    @endif
                 </section>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
