@extends('layout.app-master')

@section('content')
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
              <a class="navbar-brand" href="#">
                <img class="img-nav" src="{{ asset('images/logo.png') }}" alt="logo" height="70">
                <span style="font-family: 'Bodoni Svtytwo SC ITC TT Book', serif; letter-spacing: 2px;">
                  Telyu Canteen
              </span>
              </a>
              <div class="" id="">
                  <div class="User_option" style="margin">
                    @if (isset($cekLogin))
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>{{$userAuth['nickname']}}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/logoutt">Logout</a>
                            @if (isset($userAuth['role']) && $userAuth['role'] == 'Administrator')
                                <a class="dropdown-item" href="/panel">Panel</a>
                            @elseif(isset($userAuth['role']) && $userAuth['role'] == 'Seller') 
                                {{-- <a class="dropdown-item" href="/Myshop">Myshop</a> --}}
                                
                                <form action="/shop/byUser" method="POST">
                                  @csrf
                                  @if(Session::has('userInfo'))
                                  @php
                                      $data = Session::get('userInfo');
                                  @endphp
                                      <input type="hidden" name="user_id" value="1">
                                      {{-- <input type="hidden" name="user_id" value="{{ $data['data']['id'] }}"> --}}
                                      <button class="dropdown-item" type="submit" style="margin-left:25px" >
                                            Myshop
                                      </button>
                                  @endif
                                      
                                  
                                </form>
                            @elseif (isset($userAuth['role']) && $userAuth['role'] == 'Buyer') 
                                <a class="dropdown-item" href="/booking/detail/menu/{{ $bookingId }}">Cart</a>
                              
                            @endif
                        </div>
                    </div>
                    @else
                    <a href="/login">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Login</span>
                    </a>
                    @endif
                </div>
                  <div class="custom_menu-btn">
                      <button onclick="openNav()">
                          <img src="{{ asset('images/menu.png') }}" alt="">
                      </button>
                  </div>
                  <div id="myNav" class="overlay">
                      <div class="overlay-content">
                          <a href="/">Home</a>
                          <a href="/menu/all">Menu</a>
                          <a href="/shop/all">Toko</a>
                      </div>
                  </div>
              </div>
          </nav>
      </div>
    </header>
  
    <!-- end header section -->

    <!-- slider section -->
    <section class="slider_section ">
      <div class="container ">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <div class="detail-box">
              <h1>
                Telyu Canteen
              </h1>
              <h3>
                Makan enak, murah, dan sehat
              </h3>
            </div>
            {{-- <div class="find_container ">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <form>
                      <div class="form-row ">
                        <div class="form-group col-lg-5">
                          <input type="text" class="form-control" id="inputHotel" placeholder="Cari menu">
                        </div>
                        
                        <div class="form-group col-lg-3">
                          <div class="btn-box">
                            <button type="submit" class="btn ">Search</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="slider_container">
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img1.png" alt="images/slider-img1.png" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img2.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img3.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img4.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img1.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img2.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img3.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img4.png" alt="" />
          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->

    
  </div>

  <!-- Menu section -->


  <section class="menu_section">
    <section class="recipe_section layout_padding-top">
      <div class="container" style="margin-bottom: 70px; width: 90%; max-width: 1200px; height: 1000px; overflow-y: auto; padding-right: 2rem;">
        <div class="heading_container heading_center" style="position: sticky; top: 0; background-color: white; padding: 10px; z-index: 1000;">
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
                    <!-- <div class="col-auto">
                      <i class="fas fa-search h4 text-body"></i>
                    </div> -->
                    <!--end of col-->
                    <div class="col">
                      <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Nama Menu atau Toko" style="text-align: center;" oninput="searchMenu(this.value)">
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
        <div class="row" id="menuList">
          @foreach ($menus as $menu)
          <div class="col-sm-6 col-md-4 mx-auto menu-item"> <!-- Tambahkan kelas menu-item -->
            <div class="box">
              @if (isset($userAuth['role']) && $userAuth['role'] == 'Buyer')
                <a data-toggle="modal" data-target="#modalAddCart" data-booking-id="{{ $bookingId }}" data-menu-id="{{ $menu['id'] }}">
                  <div class="img-box">
                    <img src="" class="box-img" alt="gambar menu" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
                    {{-- <img src="{{ asset('images/n.jpg')}}" class="box-img" alt="gambar menu" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
                  </div>
                </a>
              @else
                <div class="img-box">
                  <img src="" class="box-img" alt="gambar menu" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
                  {{-- <img src="{{ asset('images/n.jpg')}}" class="box-img" alt="gambar menu" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
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
                <form action="/menu/byShop" method="POST">
                  @csrf
                  {{-- @method('get') --}}
                  <div class="img-box">
                      <input type="hidden" name="shop_id" value="{{ $menu['shop_id'] }}">
                      {{-- <img src="" class="box-img" alt="gambar shop" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
                      <div class="detail-box">
                        <button type="submit" class="shop-link-1" style="font-size: 12px;">
                          {{ $menu['shop_namaToko'] }}
                        </button>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <!-- Tambahkan elemen untuk menampilkan pesan "Menu tidak ditemukan" -->
        <div id="noMenuFound" style="display: none; text-align: center;">
          <h5>Menu atau Toko tidak ditemukan.</h5>
        </div>
      </div>
    </section>
  </section>
  


  <!-- app section -->
  <section class="app_section">
    <div class="container">
      <div class="col-md-9 mx-auto">
        <div class="row">
          <div class="col-md-7 col-lg-8">
            <div class="detail-box">
              <h2>
                <span> Get the</span> <br>
                Telyu Canteen App
              </h2>
              <p>
                Aplikasi Telyu Canteen memudahkan kamu untuk memesan makanan dan minuman di kantin TULT
              </p>
              <div class="app_btn_box">
                <a href="https://play.google.com" class="mr-1" target="_blank" >
                  <img src="images/google_play.png" class="box-img" alt="">
                </a>
                <a href="https://www.apple.com" target="_blank">
                  <img src="images/app_store.png" class="box-img" alt="" >
                </a>
              </div>
              <a href="https://play.google.com" class="download_btn" target="_blank">
                Download Now
              </a>
            </div>
          </div>
          <div class="col-md-5 col-lg-4">
            <div class="img-box">
              <img src="images/mobile.png" class="box-img" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  
  <!-- footer section -->
  <section class="footer_section">
    <div class="footer_container">
      <footer class="footer_section ">
        <div class="container">
          <p>
            &copy; <span id="displayYear"></span> Develop BY ABP Kelompok 4
          </p>
        </div>
      </footer>
    </div>
  </section>

<!-- Modal -->
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
          <input type="number" class="form-control" placeholder="Jumlah" name="quantity">
          <br>
          {{-- <input type="number" class="form-control" placeholder="Nomor Meja" name="nomorMeja"> --}}
          {{-- <br>           --}}
          {{-- <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Lokasi" name="lokasiToko"></textarea>
          </div> --}}
          <input type="hidden" name="bookingId" id="idBooking" value="{{ $bookingId }}">
          <input type="hidden" name="menuId" id="idMenu" value="{{ $menu['id'] }}">
          
          
        
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


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function(){
      $('#modalAddCart').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var idBooking = button.data('booking-id'); // Ambil nilai nama toko dari atribut data
        var idMenu = button.data('menu-id'); 
        var modal = $(this);
        // modal.find('.modal-body #oldNamaToko').val(namaToko); // Isi nilai nama toko ke dalam input dalam modal
        modal.find('#idBooking').val(idBooking);
        modal.find('#idMenu').val(idMenu);
      });
    });
  </script>
@endsection