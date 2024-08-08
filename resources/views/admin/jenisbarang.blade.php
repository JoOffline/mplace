@extends('admin.index')
@section('content')

@if(session('error'))
<script>
    window.onload = function() {
        alert('{{ session('error') }}');
    };
</script>
@endif

@if(session('success'))
<script>
    window.onload = function() {
        alert('{{ session('success') }}');
    };
</script>
@endif

@if($errors->any())
<script>
    window.onload = function() {
        let errorMessage = '';
        @foreach($errors->all() as $error)
            errorMessage += '{{ $error }}\n';
        @endforeach
        alert(errorMessage);
    };
</script>
@endif

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)"></a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title"></h4>
                                    <button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCreate"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">


                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Barang</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @php
                                              $no = 1;
                                           @endphp
                                        @foreach($category as $row)

                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->kategori }}</td>
                                                <td>
                                                    <a href="#modalEdit{{ $row->id }}" data-toggle="modal" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="#modalHapus{{ $row->id }}" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

 <div class="modal fade bd-example-modal-lg" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="post" action="{{ url('add_kategori') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Barang</label>
                        <input type="text" class="form-control" name="kategori" placeholder="Jenis Barang..." required>
                        <input type="submit" class="btn btn-primary mt-2" value="Add Category">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
 </div>
@foreach ( $category as $edit)
 <div class="modal fade bd-example-modal-lg" id="modalEdit{{ $edit->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('edit_kategori',$edit->id) }}">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Jenis Barang</label>
                    <input type="text" value="{{ $edit->kategori }}" class="form-control" name="kategori" placeholder="Jenis Barang..." required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div></form>
        </div>
    </div>
 </div>
 @endforeach
 @foreach ($category as $del)
 <div class="modal fade bd-example-modal-lg" id="modalHapus{{ $del->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="GET" action="{{ url('hapus_kategori', $del->id) }}">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <h5>Apakah Anda Ingin Menghapus Data Ini?</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i></button>
                <button type="submit" class="btn btn-delete"><i class="fa fa-trash"></i></button>
            </div></form>
        </div>
    </div>
 </div>

 @endforeach


@endsection
