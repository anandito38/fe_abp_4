@extends('layout.app-master')

@section('content')
  {{-- @php
    dd($menus)
  @endphp --}}
  <div class="hero_area">
    <!-- header section strats -->
    @include('layout.navbar')
  </div>

  <!-- recipe section -->

  <section class="recipe_section layout_padding-top">
    <div class="container" style="margin-bottom: 70px">
      <div class="heading_container heading_center">
        <h2>Menu
          @if (isset($menus ))
            {{ $menus[0]['namaToko'] }}
          @endif
        </h2>
      </div>
      <div class="row">
        @foreach ($menus as $menu)
          @if ($menu['stokMenu'] != 0)
            <div class="col-sm-6 col-md-4 mx-auto">
              <div class="box">
                @if (isset($userAuth['role']) && $userAuth['role'] == 'Buyer')
                  <a data-toggle="modal" data-target="#modalAddCart" data-booking-id="{{ $bookingId }}" data-menu-id="{{ $menu['id'] }}" data-menu-stok="{{ $menu['stokMenu'] }}">
                    <div class="img-box">
                      <img src="{{ asset($menu['imageMenu']) }}" class="box-img" alt="gambar menu" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
                      {{-- <img src="{{ asset('images/n1.jpg')}}" class="box-img" alt="gambar menu" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
                    </div>
                  </a>
                @else
                  <div class="img-box">
                    <img src="{{ asset($menu['imageMenu']) }}" class="box-img" alt="gambar menu" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
                    {{-- <img src="{{ asset('images/n1.jpg')}}" class="box-img" alt="gambar menu" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
                  </div>
                @endif
                <div class="detail-box">
                  <h4>
                    {{ $menu['namaMenu'] }}.
                    <br>
                    {{ $menu['hargaMenu'] }}
                  </h4>
                  <h6>
                    {{ $menu['deskripsiMenu'] }}</h6>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
      {{-- <div class="btn-box">
        <a href="">
          Order Now
        </a>
      </div> --}}
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
            @if(isset($bookingId))
              <input type="hidden" name="bookingId" id="idBooking" value="{{ $bookingId }}">
            @endif
            <input type="hidden" name="menuId" id="idMenu" value="{{ $menu['id'] }}">
            <input type="hidden" name="stokMenu" id="stokMenu2  " value="{{ $menu['stokMenu'] }}">

            
          
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
