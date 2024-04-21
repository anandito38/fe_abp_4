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
        <h2>Menu
            

        </h2>
        <div class="row">
          
          @php
            $semuaSelesai = true;
        @endphp

        @foreach ($menus as $menu)
            @if($menu['quantity'][0]['statusMasak'] != 'Selesai')
            @php
                    $semuaSelesai = false;
                @endphp
            @endif
        @endforeach
        @if(!$semuaSelesai)
        <table class="table table-bordered table-striped" style="margin-top: 2rem; margin-left: auto; margin-right: auto;">
          <thead>
            <tr>
              <th>Nama Menu</th>
              <th class="col-auto" >Jumlah</th>
                  <th class="col-auto" style="width: 15rem">Aksi</th>
                </tr>
          </thead>
          <tbody>
            @if (isset($menus))
            @foreach ($menus as $menu)
                @if($menu['quantity'][0]['statusMasak'] != 'Selesai')
                  <tr>
                    <td>{{ $menu['menu']['id'] }}{{ $menu['menu']['namaMenu'] }}</td>
                    <td>{{ $menu['quantity'][0]['banyakPesanan' ] }}</td>
                      {{-- <td>{{ $menu['quantity'] }}</td> --}}
                      <td class="col-auto">
                        <div class="d-flex">
                          <a data-toggle="modal" data-target="#modalConfirmSelesai" data-toggle="modal" data-target="#modalConfirmDelete"  data-booking-id="{{ $menu['booking']['id'] }}" data-menu-id="{{ $menu['menu']['id'] }}" data-shop-id="{{ $menu['menu']['shop_id'] }}" >
                                <button type="button" class="btn btn"style="border: 2px solid green; background-color: transparent; color: green;" data-toggle="modal" data-target="#modalConfirmSelesai" data-toggle="modal" data-target="#modalConfirmDelete"  data-booking-id="{{ $menu['booking']['id'] }}" data-menu-id="{{ $menu['menu']['id'] }}" data-shop-id="{{ $menu['menu']['shop_id'] }}" >
                                  Selesai
                                </button>
                              </a>

                            
                          </div>
                        </td>
                      </tr>
                      @endif
                      @endforeach
                      @endif
          </tbody>
        </table>
        @else
        
            <div class="heading_container heading_center">
              <h4 style="margin-top: 2rem">Belum ada pesanan baru</h4>
            </div>
        @endif
      </div>
      </div>
      
    </div>
  </section>

  
  <!-- ModalConfirmDelete -->
  @if (isset($menus) && !empty($menus))
  <div class="modal fade" id="modalConfirmSelesai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->
        <div class="modal-header d-flex justify-content-center">
          <h3 class="heading" style="font-family: 'Bodoni Svtytwo SC ITC TT Book', serif;">Confirm Delete</h3>
        </div>
        <!--Modal Body-->
        <div class="modal-body">
          <p style="font-family: Verdana, Geneva, Tahoma, sans-serif">Pesanan ini selesai?</p>
          <form id="deleteShopForm" action="/menu/done/paid/byShop" method="POST">
            @csrf
            @method('post')
            
            <input type="text" name="menu_id" id="menu_id" value="{{ $menu['menu']['id'] }}">
            <input type="hidden" name="shop_id" id="shop_id" value="{{ $menu['menu']['shop_id'] }}">
            <input type="hidden" name="booking_id" id="booking_id" value="{{ $menu['booking']['id'] }}">
            <!--Footer-->
            <div class="modal-footer flex-center">
              <button type="submit" class="btn btn-danger">Yes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
          </form>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  @endif
  <!-- EndModal -->


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function(){
      $('#modalConfirmSelesai').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var booking_id = button.data('booking-id');
        var shop_id = button.data('shop-id');
        var menu_id = button.data('menu-id');
        var modal = $(this);
        modal.find('#menu_id').val(menu_id);
        modal.find('#shop_id').val(shop_id);
        modal.find('#booking_id').val(booking_id);
      });
    });
  </script>
@endsection