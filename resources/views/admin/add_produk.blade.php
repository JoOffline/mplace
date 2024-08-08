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
                                    <th>Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                               @php
                                  $no = 1;
                               @endphp
                            @foreach ($product as $produk)
                            <tr>
                                <td>{{ $produk->title }}</td>
                                <td>{!!Str::limit ($produk->description,50) !!}</td>
                                <td>{{ $produk->kategori }}</td>
                                <td>{{ $produk->price }}</td>
                                <td>{{ $produk->quantity }}</td>
                                <td>
                                    <img style="max-height: 50%; max-width: 60%;" src="products/{{ $produk->image }}">
                                </td>
                                <td>
                                    <a href="#modalEdit{{ $produk->id }}" data-toggle="modal" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="#modalHapus{{ $produk->id }}" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
            </div>
            <div class="modal fade bd-example-modal-lg" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ url('upload_produk') }}" enctype="multipart/form-data">
                            @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="title" placeholder="Nama Barang..." required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description" placeholder="Nama Barang..." required>
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <div class="input-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Stok ..." required>
                                    <div class="input-group-append"><span class="input-group-text">Pcs</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" name="price" class="form-control" placeholder="Harga ..." required>
                                    <div class="input-group-append">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Jenis Barang</label>
                                <select class="form-control" name="category_id" required>
                                    <option value="" hidden>-- Pilih Jenis Barang --</option>
                                    @foreach ( $data_jenis as $category )
                                    <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>
             </div>


             @foreach ($product as $del)
             <div class="modal fade bd-example-modal-lg" id="modalHapus{{ $del->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <form method="GET" action="{{ url('hapus_produk', $del->id) }}">
                            @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <h5>Apakah Anda Ingin Menghapus Data Ini?</h5>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i></button>
                            <button type="submit" class="btn btn-delete mt-1"><i class="fa fa-trash"></i></button>
                        </div></form>
                    </div>
                </div>
             </div>

             @endforeach
             @foreach ( $product as $edit )
             <div class="modal fade bd-example-modal-lg" id="modalEdit{{ $edit->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ url('update_produk', $edit->id) }}" enctype="multipart/form-data">
                            @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="title" placeholder="Nama Barang..." required value="{{ $edit->title }}">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" class="form-control" name="description" placeholder="Nama Barang..." required value="{{ $edit->description }}">
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <div class="input-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Stok ..." required value="{{ $edit->quantity }}">
                                    <div class="input-group-append"><span class="input-group-text">Pcs</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" name="price" class="form-control" placeholder="Harga ..." required value="{{ $edit->price }}">
                                    <div class="input-group-append">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jenis Barang</label>
                                <select class="form-control" name="category" required>
                                    <option value="{{ $edit->category_id }}" hidden>{{ $edit->kategori }}</option>
                                    @foreach ( $data_jenis as $category )
                                    <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                                    @endforeach



                                </select>
                            </div>


                            <div class="form-group">
                                <label>Image</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>
             </div>
             @endforeach
@endsection
