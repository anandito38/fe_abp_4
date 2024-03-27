@extends('layout.app-master')

@section('content')
  {{-- @php
    dd($menus)
  @endphp --}}
  <div class="hero_area">
    <!-- header section strats -->
    @include('layout.navbar')
  </div>

  <section class="recipe_section layout_padding-top">
    <div class="container" style="margin-bottom: 70px">
      <div class="heading_container heading_center">
        <h2>
          Menu Kantin 
        </h2>
      </div>
      <div>
        <div class="container">
          <br/>
          <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-6">
              <form class="card card-sm">
                <div class="card-body row no-gutters align-items-center">
                  {{-- <div class="col-auto">
                    <i class="fas fa-search h4 text-body"></i>
                  </div> --}}
                  <!--end of col-->
                  <div class="col">
                    <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Nama Menu atau Toko" style="text-align: center;" oninput="searchMenu(this.value)">
                  </div>
                  <!--end of col-->
                  {{-- <div class="col-auto">
                    <button class="btn btn-lg btn-success" type="submit">Search</button>
                  </div> --}}
                  <!--end of col-->
                </div>
              </form>
            </div>
            <!--end of col-->
          </div>
        </div>
      </div>
      <div class="row" id="menuList">
        @foreach ($menus as $menu)
        <div class="col-sm-6 col-md-4 mx-auto menu-item"> <!-- Tambahkan kelas menu-item -->
          <div class="box">
            <a href="/shop/{{ $menu['shop_id'] }}">
              <div class="img-box">
                <img src="" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
                {{-- <img src="{{ asset('images/n1.jpg')}}" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
              </div>
            </a>
            <div class="detail-box">
              <h4>
                {{ $menu['namaMenu'] }}.
                <br>
                {{ $menu['hargaMenu'] }}
              </h4>
              <h6>
                {{ $menu['deskripsiMenu'] }} dari
                {{ $menu['shop_namaToko'] }}
              </h6>
              <a href="/shop/{{ $menu['shop_id'] }}">Go</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <!-- Tambahkan elemen untuk menampilkan pesan "Menu tidak ditemukan" -->
      <div id="noMenuFound" style="display: none; text-align: center;">
        <p>Menu atau Toko tidak ditemukan.</p>
      </div>
    </div>
  </section>

  <script>
    function searchMenu(keyword) {
      // Ambil semua elemen menu
      var menus = document.querySelectorAll('#menuList .menu-item'); // Ubah pemilihan menjadi kelas menu-item
      var noMenuFound = document.getElementById('noMenuFound'); // Ambil elemen untuk pesan "Menu tidak ditemukan"
      var menuFound = false; // Inisialisasi variabel untuk menandai apakah menu ditemukan
      
      // Loop melalui setiap elemen menu
      menus.forEach(function(menu) {
        var namaMenu = menu.querySelector('h4').textContent.toLowerCase();
        var deskripsiMenu = menu.querySelector('h6').textContent.toLowerCase();
        
        // Periksa apakah keyword cocok dengan nama menu atau deskripsi menu
        if (namaMenu.includes(keyword.toLowerCase()) || deskripsiMenu.includes(keyword.toLowerCase())) {
          menu.style.display = 'block'; // Tampilkan elemen menu jika cocok
          menuFound = true; // Setel variabel menuFound menjadi true karena menu ditemukan
        } else {
          menu.style.display = 'none'; // Sembunyikan elemen menu jika tidak cocok
        }
      });

      // Tampilkan pesan "Menu tidak ditemukan" jika tidak ada menu yang ditemukan
      if (!menuFound) {
        noMenuFound.style.display = 'block';
      } else {
        noMenuFound.style.display = 'none';
      }
    }
  </script>
@endsection
