<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        @foreach ( $product as $produk )
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box" style="border-radius: 5px">
              <a href="">
                <div class="img-box">
                  <img src="{{ asset('products/' . $produk->image) }}" alt="{{ $produk->title }}">
                </div>
                <div class="detail-box">
                  <h6>
                    {{ $produk->title }}
                  </h6>
                  <h6>
                    Price
                    <span>
                      ${{ $produk->price }}
                    </span>
                  </h6>
                </div>
                <div style="">
                    <button class="btn btn-danger" style="color: white" data-toggle="modal" data-target="#myModal">Details</button>
                    <a class="btn btn-secondary" style="color: white" href="{{ url('add_cart',$produk->id) }}">Add to Carts</a>
                </div>
                <div class="new">
                  <span>
                    New
                  </span>
                </div>
              </a>
            </div>
          </div>
        @endforeach
        @foreach ( $product as $details )

        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">{{ $details->title }}</h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <img style="max-width: 100%; max-height: 100px; object-fit: cover; width: auto; height: auto;" src="{{ asset('products/' . $details->image) }}" alt="{{ $details->title }}">
                  <p>Deskripsi Produk: {{ $details->description }}</p>
                  <p>Kategori Produk: {{ $details->kategori }}</p>
                  <p>Harga: {{ $details->price }}</p>
                  <p>Stok: {{ $details->quantity }}</p>


                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

              </div>
            </div>
          </div>
      </div>
        @endforeach



    </div>
  </section>
