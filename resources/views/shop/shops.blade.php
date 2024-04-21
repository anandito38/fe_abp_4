@extends('layout.app-master')

@section('content')
  <div class="hero_area">
    <!-- header section strats -->
    @include('layout.navbar')
    <!-- end header section -->
  </div>


  <!-- recipe section -->

  <section class="recipe_section layout_padding-top">
    <div class="container" style="margin-bottom: 70px">
      <div class="heading_container heading_center">
        <h2>
          Kunjungi Toko Kami
        </h2>
      </div>

      <div>
        <div class="container">
          <br/>
          <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-6">
              <form class="card card-sm">
                <div class="card-body row no-gutters align-items-center">
                  <!-- <div class="col-auto">
                    <i class="fas fa-search h4 text-body"></i>
                  </div> -->
                  <!--end of col-->
                  <div class="col">
                    <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Nama Toko" style="text-align: center;" oninput="searchToko(this.value)">
                  </div>
                  <!--end of col-->
                  <!-- <div class="col-auto">
                    <button class="btn btn-lg btn-success" type="submit">Search</button>
                  </div> -->
                  <!--end of col-->
                </div>
              </form>
            </div>
            <!--end of col-->
          </div>
        </div>
      </div>

      <div class="row" id="shopList">

        @foreach ($shops as $shop)
          <div class="col-sm-6 col-md-4 mx-auto shop-item" data-name="{{ $shop['namaToko'] }}">
            <div class="box">
              <form action="/menu/byShop" method="POST">
                @csrf
                {{-- @method('get') --}}
                <div class="img-box">
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                    <img src="{{ asset($shop['image']) }}" class="box-img" alt="gambar shop" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
                    {{-- <img src="{{ asset('images/toko.png')}}" class="box-img" alt="gambar shop" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">> --}}
                    <div class="detail-box">
                      <button type="submit" class="shop-link">
                        Go!
                      </button>
                    </div>
                </div>
              </form>
              <div class="detail-box">
                <h4>
                  {{ $shop['nomorToko'] }}.
                  {{ $shop['namaToko'] }}
                </h4>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div id="noShopFound" style="display: none; text-align: center;">
          <h3>Toko tidak ditemukan.</h3>
      </div>
    </div>
  </section>

  <script>
    function searchToko(keyword) {
        // Ambil semua elemen toko
        var shops = document.querySelectorAll('#shopList .shop-item');
        var noShopFound = document.getElementById('noShopFound');

        var shopFound = false; // Inisialisasi variabel untuk menandai apakah toko ditemukan

        // Loop melalui setiap elemen toko
        shops.forEach(function(shop) {
            var namaToko = shop.getAttribute('data-name');
            
            // Periksa apakah keyword cocok dengan nama toko
            if (namaToko.includes(keyword.toLowerCase())) {
                shop.style.display = 'block'; // Tampilkan elemen toko jika cocok
                shopFound = true; // Setel variabel shopFound menjadi true karena toko ditemukan
            } else {
                shop.style.display = 'none'; // Sembunyikan elemen toko jika tidak cocok
            }
        });

        // Tampilkan pesan "Toko tidak ditemukan" jika tidak ada toko yang ditemukan
        if (!shopFound) {
            noShopFound.style.display = 'block';
        } else {
            noShopFound.style.display = 'none';
        }
    }
  </script>
@endsection
