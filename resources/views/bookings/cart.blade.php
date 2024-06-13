@extends('layout.app-master')

@section('content')
  {{-- @php
    dd($menus)
  @endphp --}}
  <div class="hero_area">
    <!-- header section strats -->
    @include('layout.navbar')
  </div>

  <!-- section -->

  <section class="recipe_section layout_padding-top">
    <div class="container" style="margin-bottom: 70px">
      <div class="heading_container heading_center">
        <h2>Keranjang</h2>
      </div>

      @if (isset($carts) && count($carts) > 0)
        <div class="table-responsive" style="padding-left: 4rem; padding-right: 4rem;">
            <button type="button" class="btn btn" style="border: 2px solid blue; background-color: transparent; color: blue;" data-toggle="modal" data-target="#modalCheckout"  data-id-booking="{{ $bookingId }}" >
              Checkout
            </button>
          {{-- <form action="/invoice/add" method="POST">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $bookingId }}">
            <button type="submit" class="btn btn-primary" style="margin-top: 2rem">Checkout</button>
          </form> --}}
          <table class="table table-bordered table-striped" style="margin-top: 2rem; margin-left: auto; margin-right: auto;">
              <thead>
                  <tr>
                      <th>Nama Menu</th>
                      <th class="col-auto" style="width: 14rem">Harga</th>
                      <th class="col-auto" style="width: 10rem">Stok Tersedia</th>
                      <th class="col-auto" style="width: 10rem">Jumlah</th>
                      <th class="col-auto" style="width: 8rem">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($carts as $cart)
                      <tr>
                          <td>{{ $cart['Menu']['namaMenu'] }}</td>
                          <td>{{ $cart['Menu']['hargaMenu'] }}</td>
                          <td>{{ $cart['Menu']['stokMenu'] }}</td>
                          <td>{{ $cart['quantity'] }}</td>
                          <td class="col-auto">
                              <div class="d-flex">
                                <a data-toggle="modal" data-target="#modalEditCart" data-id-menu="{{ $cart['Menu']['id'] }}" data-id-booking="{{ $bookingId }}" data-quantity="{{ $cart['quantity'] }}" data-stok="{{ $cart['Menu']['stokMenu'] }}"  >
                                  <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#modalEditCart"  data-id-menu="{{ $cart['Menu']['id'] }}" data-id-booking="{{ $bookingId }}" data-quantity="{{ $cart['quantity'] }}" data-stok="{{ $cart['Menu']['stokMenu'] }}">
                                    Edit
                                  </button>
                                </a>
                                
                                <a data-toggle="modal" data-target="#confirmDelete" data-booking-id="{{ $bookingId }}" data-menu-id="{{ $cart['Menu']['id'] }}">
                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDelete"  data-booking-id="{{ $bookingId }}" data-menu-id="{{ $cart['Menu']['id'] }}">
                                    Delete
                                  </button>
                                </a>

                                
                              </div>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>

        </div>
        
      @else
        <div class="heading_container heading_center">
          <h4 style="margin-top: 2rem">Belum ada item ditambahkan</h4>
        </div>
      @endif
    </div>
  </section>
  

  <!-- ModalEditCart -->
  @if (isset($carts) && !empty($carts))
  <div class="modal fade" id="modalEditCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <h3 class="heading" style="font-family: 'Bodoni Svtytwo SC ITC TT Book', serif;">Edit Toko</h3>
          </div>

          <!--Modal Body-->
          <div class="modal-body">
            {{-- <p style="font-family: Verdana, Geneva, Tahoma, sans-serif">Masukkan Jumlah</p> --}}
            <form id="EditCartForm" action="/menu/cart/edit" method="POST">
              @csrf
              @method('post')
              <label for="quantity">Jumlah</label>
              <input type="text" class="form-control" placeholder="Jumlah" name="quantity" id="quantity" value="{{ $cart['quantity'] }}">
              <br>
              <input type="hidden" name="menuId" id="menuId" value="{{ $cart['Menu']['id'] }}">         
              <input type="hidden" name="bookingId" id="bookingId" value="{{ $bookingId }}">         
              <input type="hidden" name="stokMenu" id="stok" value="{{ $cart['Menu']['stokMenu'] }}">         
              
              
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


  <!-- ModalConfirmDelete -->
  @if (isset($carts) && !empty($carts))
    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <h3 class="heading" style="font-family: 'Bodoni Svtytwo SC ITC TT Book', serif;">Confirm Delete</h3>
          </div>
          <!--Modal Body-->
          <div class="modal-body">
            <p style="font-family: Verdana, Geneva, Tahoma, sans-serif">Are you sure you want to delete this menu?</p>
            <form id="deleteCartForm" action="/menu/cart/delete" method="POST">
              @csrf
              @method('post')
              <input type="hidden" name="bookingId" id="bookingId" value="{{ $bookingId }}">
              <input type="hidden" name="menuId" id="menuId" value="{{ $cart['Menu']['id'] }}">
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

  <!-- Modal Checkout -->
  @if (isset($carts) && !empty($carts))
    <div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <h3 class="heading" style="font-family: 'Bodoni Svtytwo SC ITC TT Book', serif;">Checkout</h3>
          </div>
          <!--Modal Body-->
          <div class="modal-body">
            <form id="Checkout" action="/invoice/add" method="POST">
              @csrf
              @method('post')
              <input type="hidden" name="bookingId" id="bookingId" value="{{ $bookingId }}">
              <label for="nomorMeja">Nomor Meja</label>
              <input type="number" name="nomorMeja" placeholder="isi jika Dine in">
              <br>
              <label for="waktuAmbil">Waktu Ambil</label>
              <input type="time" name="waktuAmbil" style="margin-top: 1rem" required>
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
      $('#modalEditCart').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var bookingId = button.data('id-booking'); // Ambil nilai nama toko dari atribut data
        var menuId = button.data('id-menu'); 
        var quantity = button.data('quantity'); 
        var stok = button.data('stok'); 
        var modal = $(this);
        modal.find('#menuId').val(menuId);
        modal.find('#bookingId').val(bookingId);
        modal.find('#quantity').val(quantity);
        modal.find('#stok').val(stok);
      });
    });
  </script>

  <script>
    $(document).ready(function(){
      $('#modalConfirmDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var bookingId = button.data('booking-id'); // Ambil nilai nama toko dari atribut data
        var menuId = button.data('menu-id'); // Ambil nilai id toko dari atribut data
        var modal = $(this);
        modal.find('#bookingId').val(bookingId);
        modal.find('#menuId').val(menuId);
      });
    });
  </script>

  <script>
    $(document).ready(function(){
      $('#modalCheckout').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var bookingId = button.data('booking-id'); // Ambil nilai nama toko dari atribut data
        var modal = $(this);
        modal.find('#bookingId').val(bookingId);
      });
    });
  </script>


<!-- Modal -->
  {{-- <div class="modal fade" id="modalTambahMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <h3 class="heading" style="font-family: 'Bodoni Svtytwo SC ITC TT Book', serif;">Tambah Menu</h3>
      </div>

      <!--Modal Body-->
      <div class="modal-body">
        <p style="font-family: Verdana, Geneva, Tahoma, sans-serif">Masukkan Jumlah</p>
        <form>
          <input type="number" class="form-control" placeholder="Jumlah" name="jumlahMenu">
          <input type="hidden" name="menu_id" value="{{ $menu['id'] }}">
        </form>


      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a href="" class="btn  btn-outline-danger">Yes</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
    </div>
  </div> --}}
<!-- EndModal -->
@endsection
