@extends('admin.index')
@section('content')
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
                                    <th>Nama Pelanggan</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ( $data as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->rec_address }}</td>
                                    <td>{{ $data->phone }}</td>
                                    <td>{{ $data->product->title }}</td>
                                    <td>{{ $data->product->price }}</td>
                                    <td><img style="margin:auto; max-width: 100%; max-height: 100px; object-fit: cover;" src="{{ asset('products/' . $data->product->image) }}" alt="{{ $data->product->title }}"></td>
                                    <td>{{ $data->status }}</td>
                                    <td>
                                        <a type="button" class="btn btn-primary btn-round m-1" href="{{ url('otw',$data->id) }}">On The Way</a>
                                        <a type="button" class="btn btn-success btn-round m-1" href="{{ url('delivered',$data->id) }}">Delivered</a>
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
@endsection
