<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    @include('home.css')
        <style>
            .form-section {
                padding: 20px;
                border-radius: 10px;
                background-color: #f8f9fa;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .form-section label {
                font-weight: bold;
            }

            .form-section input,
            .form-section textarea {
                margin-bottom: 15px;
            }

            .form-section button {
                width: 100%;
            }
        </style>
</head>
<body>

    <div class="hero_area">
        <!-- header section starts -->
        @include('home.header')
        <!-- end header section -->

        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Keranjang Belanja</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php $value = 0; ?>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Gambar</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $cart)
                                        <tr>
                                            <td>{{ $cart->product->title }}</td>
                                            <td>{{ $cart->product->price }}</td>
                                            <td><img style="margin:auto; max-width: 100%; max-height: 100px; object-fit: cover;" src="{{ asset('products/' . $cart->product->image) }}" alt="{{ $cart->product->title }}"></td>
                                            <td><a href="{{ url('del_cart', $cart->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')" class="btn btn-danger fa fa-trash m-auto">Hapus</a></td>
                                        </tr>
                                        <?php $value += $cart->product->price; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <h4 class="card-title">Total Harga: ${{ $value }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ url('confirm_order') }}" class="mt-4 form-section" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Penerima:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat Penerima:</label>
                            <input class="form-control" id="address" name="address" placeholder="Alamat" value="{{ Auth::user()->address }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Penerima:</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor Telepon" value="{{ Auth::user()->phone }}">
                        </div>

                        <div class="form-group">
                            <a class="btn btn-primary" style="color: white" type="submit">Bayar Tunai</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
