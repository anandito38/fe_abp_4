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
          Menu Kantin {{$bookingId}}
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
          @if ($menu['stokMenu'] != 0)
            <div class="col-sm-6 col-md-4 mx-auto menu-item"> <!-- Tambahkan kelas menu-item -->
              <div class="box">
                @if (isset($userAuth['role']) && $userAuth['role'] == 'Buyer')
                  <a data-toggle="modal" data-target="#modalAddCart" data-booking-id="{{ $bookingId }}" data-menu-id="{{ $menu['id'] }}" data-menu-stok="{{ $menu['stokMenu'] }}">
                    <div class="img-box">
                      <img src="{{ asset($menu['imageMenu']) }}" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
                      {{-- <img src="{{ asset('images/n1.jpg')}}" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
                    </div>
                  </a>
                @else
                  <div class="img-box">
                    <img src="{{ asset($menu['imageMenu']) }}" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
                    {{-- <img src="{{ asset('images/n1.jpg')}}" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
                  </div>
                @endif
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
                  {{-- <a href="/shop/{{ $menu['shop_id'] }}">Go</a> --}}
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
      <!-- Tambahkan elemen untuk menampilkan pesan "Menu tidak ditemukan" -->
      <div id="noMenuFound" style="display: none; text-align: center;">
        <p>Menu atau Toko tidak ditemukan.</p>
      </div>
    </div>
  </section>

<!-- Modal -->
@if (isset($menus) && !empty($menus))
  <div class="modal fade" id="modalAddCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->
        <div class="modal-header d-flex justify-content-center">
          <h3 class="heading" style="font-family: 'Bodoni Svtytwo SC ITC TT Book', serif;">Tambah Menu</h3>
        </div>

        <!--Modal Body-->
        <div class="modal-body">
          {{-- <p style="font-family: Verdana, Geneva, Tahoma, sans-serif">Masukkan Jumlah</p> --}}
          <form id="Cekout" action="/menu/cart/add" method="POST">
            @csrf
            @method('post')
            <input type="number" class="form-control" id="stokMenu" placeholder="Sisa Stok: {{ $menu['stokMenu'] }}" name="quantity">
            <br>
            <input type="hidden" name="bookingId" id="idBooking" value="{{ $bookingId }}">
            <input type="hidden" name="menuId" id="idMenu" value="{{ $menu['id'] }}">
            <input type="hidden" name="stokMenu2" id="stokMenu" value="{{ $menu['stokMenu'] }}">

            
          
            <!--Footer-->
            <div class="modal-footer flex-center">
              {{-- <a href="" class="btn  btn-outline-danger">Yes</a> --}}
              <button type="submit" class="btn btn-success">Submit</button>
              <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Cancel</a>
            </div>
          </form>
        </div>

        
      </div>
      <!--/.Content-->
    </div>
  </div>
@endif
<!-- EndModal -->
  
  
  
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
  <script>
    $(document).ready(function(){
      $('#modalAddCart').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var idBooking = button.data('booking-id'); // Ambil nilai nama toko dari atribut data
        var idMenu = button.data('menu-id');
        var stokMenu = button.data('menu-stok'); 
        var modal = $(this);
        // modal.find('.modal-body #oldNamaToko').val(namaToko); // Isi nilai nama toko ke dalam input dalam modal
        modal.find('#idBooking').val(idBooking);
        modal.find('#idMenu').val(idMenu);
        modal.find('#stokMenu').attr('placeholder', 'Sisa Stok: ' + stokMenu);
        modal.find('#stokMenu2').val(stokMenu);
      });
    });
  </script>
@endsection
