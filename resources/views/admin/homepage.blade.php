@extends('admin.index')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">New Customers</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $user }}</h2>
                        <p class="text-white mb-0">Total Customer</p>

                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Products</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $barang }}</h2>
                        <p class="text-white mb-0">Our Product</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Order</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $order }}</h2>
                        <p class="text-white mb-0">total order</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>


    </div>
    <div class="row">

        @foreach ($product as $row)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $row->title }}</h4>
                        <img style="max-width: 100%; max-height: 100px; object-fit: cover; width: auto; height: auto;" src="{{ asset('products/' . $row->image) }}" alt="{{ $row->title }}">
                    </div>
                    <div class="card-body">

                        <p class="card-text">Jenis: {{ $row->kategori }}</p>
                        <p class="card-text">Stok: {{ $row->quantity }}</p>
                        <p class="card-text">Harga: {{ number_format($row->price) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

