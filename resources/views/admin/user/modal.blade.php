@foreach ($users as $item)
{{-- edit user --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Users</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ url("edituser/$item->id") }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputnama3" class="col-sm-2 col-form-label">nama</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $item->name }}" class="form-control"
                                        id="inputnama3" placeholder="nama" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" value="{{ $item->email }}" class="form-control"
                                        id="inputEmail3" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2bs4 select2-hidden-accessible" name="role"
                                        id="">
                                        <option value="admin">Admin</option>
                                        <option value="CS">CS</option>
                                        <option value="CS">Manager</option>
                                        <option value="CS">User</option>
                                    </select>
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



{{-- add user --}}
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Add Users</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="adduser" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputnama3" class="col-sm-2 col-form-label">nama</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="inputnama3"
                                    placeholder="nama" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email"  class="form-control" id="inputEmail3"
                                    placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputpassword3" class="col-sm-2 col-form-label">password</label>
                            <div class="col-sm-10">
                                <input type="password"  class="form-control" id="inputpassword3"
                                    placeholder="password" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-control select2bs4 select2-hidden-accessible" name="role"
                                    id="">
                                    <option value="admin">Admin</option>
                                    <option value="CS">CS</option>
                                    <option value="CS">Manager</option>
                                    <option value="CS">User</option>
                                </select>
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
