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
          List Toko
        </h2>
      </div>
      <div class="row">
          
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <a data-toggle="modal" data-target="#modalTambahShop">
              <div class="img-box">
                <img src="" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example (copy)';">
                {{-- <img src="{{ asset('images/n1.jpg')}}" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
              </div>
            </a>
          </div>
        </div>
          


        {{-- @php
          dd($shops)
        @endphp         --}}
        @if (isset($shops))
          @foreach ($shops as $shop)
          <div class="col-sm-6 col-md-4 mx-auto">
            <div class="box">
              
              <div class="img-box">
                <a data-toggle="modal" data-target="#modalEditShop" data-nama-toko="{{ $shop['namaToko'] }}" data-nomor-toko="{{ $shop['nomorToko'] }}" data-lokasi-toko="{{ $shop['lokasiToko'] }}"  data-id-toko="{{ $shop['id'] }}">
                  <img src="{{ asset($shop['image']) }}" class="box-img" alt="gambar shop" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
                </a>
              </div>

              {{-- form pergi ke menu toko --}}
              <form action="/shop/byUser/menu" method="POST" class="d-inline-block mr-2 mt-3">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                <button type="submit" class="btn" style="border: 2px solid black; background-color: transparent; color: black;">Menu</button>
              </form>
              
              {{-- form pergi ke pesanan toko --}}
              <form action="/shop/booking/menu" method="POST" class="d-inline-block mr-2">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                <button type="submit" class="btn" style="border: 2px solid black; background-color: transparent; color: black;">Pesanan</button>
              </form>

              {{-- button delete toko --}}
              <button type="button" class="btn d-inline-block" style="border: 2px solid red; background-color: transparent; color: red;" data-toggle="modal" data-target="#modalConfirmDelete" data-shop-id="{{ $shop['id'] }}">Delete</button>
            
                
              <div class="detail-box">
                <h4>
                  {{ $shop['nomorToko'] }} | {{ $shop['namaToko'] }}.
                  <br>
                  {{ $shop['lokasiToko'] }}
                  
                </h4>
              </div>
            </div>
          </div>
          @endforeach

        @endif
      </div>
      
    </div>
  </section>

  <!-- ModalTambahShop -->
  <div class="modal fade" id="modalTambahShop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->
        <div class="modal-header d-flex justify-content-center">
          <h3 class="heading" style="font-family: 'Bodoni Svtytwo SC ITC TT Book', serif;">Tambah Toko</h3>
        </div>

        <!--Modal Body-->
        <div class="modal-body">
          {{-- <p style="font-family: Verdana, Geneva, Tahoma, sans-serif">Masukkan Jumlah</p> --}}
          <form id="IputShopForm" action="/shop/add" method="POST">
            @csrf
            @method('post')
            <input type="text" class="form-control" placeholder="Nama" name="namaToko">
            <br>
            <input type="number" class="form-control" placeholder="Nomor gunakan 0 didepan" name="nomorToko">
            <br>
            {{-- <div class="form-group">
            <input type="text" class="form-control" placeholder="Deskripsi" name="deskripsiMenu" style="height: 100px; padding-bottom: 3rem; overflow-y: auto;">
            </div> --}}
            <div class="form-group">
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Lokasi" name="lokasiToko"></textarea>
            </div>
            <input type="hidden" name="user_id" value="{{ $user_id }}">
          
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

  <!-- ModalEditShop -->
  @if (isset($shops) && !empty($shops))
  <div class="modal fade" id="modalEditShop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form id="EditShopForm" action="/shop/edit" method="POST" enctype="multipart/form-data">
              @csrf
              @method('post')
              <input type="text" class="form-control" placeholder="Nama" name="namaToko" id="oldNamaToko" value="{{ $shop['namaToko'] }}">
              <br>
              <input type="number" class="form-control" placeholder="Nomor gunakan 0 didepan" name="nomorToko" id="oldNomorToko" value="{{ $shop['nomorToko'] }}">
              <br>
              
              <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Lokasi" name="lokasiToko" id="oldLokasiToko" value="{{ $shop['lokasiToko'] }}"></textarea>
              </div>
              <div class="form-group">
                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" >
              </div>
              <input type="hidden" name="user_id" value="{{ $user_id }}">
              <input type="hidden" name="id" id="idToko" value="{{ $shop['id'] }}">            
              
              <!--Footer-->
              <div class="modal-footer flex-center">
                {{-- <a href="" class="btn  btn-outline-danger">Yes</a> --}}
                <button type="submit" class="btn" style="border: 2px solid green; background-color: transparent; color: green;">Submit</button>
                <a type="button" class="btn waves-effect" style="border: 2px solid red; background-color: transparent; color: red;"data-dismiss="modal">Cancel</a>
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
  @if (isset($shops) && !empty($shops))
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
          <p style="font-family: Verdana, Geneva, Tahoma, sans-serif">Are you sure you want to delete this shop?</p>
          <form id="deleteShopForm" action="/shop/delete" method="POST">
            @csrf
            @method('post')
            <input type="hidden" name="shopId" id="shopId" value="{{ $shop['id'] }}">
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
      $('#modalEditShop').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var namaToko = button.data('nama-toko'); // Ambil nilai nama toko dari atribut data
        var nomorToko = button.data('nomor-toko'); 
        var lokasiToko = button.data('lokasi-toko');
        var idToko = button.data('id-toko'); 
        var modal = $(this);
        // modal.find('.modal-body #oldNamaToko').val(namaToko); // Isi nilai nama toko ke dalam input dalam modal
        modal.find('#oldNamaToko').val(namaToko);
        modal.find('#oldNomorToko').val(nomorToko);
        modal.find('#oldLokasiToko').val(lokasiToko); 
        modal.find('#idToko').val(idToko); 
      });
    });
  </script>
  
  <script>
    $(document).ready(function(){
      $('#modalConfirmDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var shopId = button.data('shop-id'); // Ambil nilai nama toko dari atribut data
        var modal = $(this);
        modal.find('#shopId').val(shopId);
      });
    });
  </script>
  
@endsection