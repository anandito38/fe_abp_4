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
        <h2>Menu Toko
    
            {{ $shop_id }}

        </h2>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <a data-toggle="modal" data-target="#modalTambahMenu">
              <div class="img-box">
                <img src="" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example (copy 1)';">
                {{-- <img src="{{ asset('images/n1.jpg')}}" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
              </div>
            </a>
          </div>
        </div>


        
        @if (isset($menus))
          @foreach ($menus as $menu)
          <div class="col-sm-6 col-md-4 mx-auto">
            <div class="box">
              
                <div class="img-box">
                  <a data-toggle="modal" data-target="#modalEditMenu" data-nama-menu="{{ $menu['namaMenu'] }}" data-harga-menu="{{ $menu['hargaMenu'] }}" data-deskripsi-menu="{{ $menu['deskripsiMenu'] }}" data-id-menu="{{ $menu['id'] }}">
                    <img src="" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
                    {{-- <img src="{{ asset('images/n1.jpg')}}" class="box-img" alt="" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';"> --}}
                  </a>
                </div>
              
              <div class="detail-box">
                <h4>
                  {{ $menu['namaMenu'] }}.
                  <br>
                  {{ $menu['hargaMenu'] }}
                </h4>
                <h6>
                  {{ $menu['deskripsiMenu'] }}
                </h6>
                <h6 style="{{ $menu['stokMenu'] == 0 ? 'color: red;' : '' }}">
                  stok : 
                  {{ $menu['stokMenu'] }}
                </h6>
              </div>
            </div>
          </div>
          @endforeach

        @endif
      </div>
      
    </div>
  </section>

  <!-- Modal Add Menu -->
  <div class="modal fade" id="modalTambahMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form id="IputMenuForm" action="/menu/add" method="POST">
            @csrf
            @method('post')
            <input type="text" class="form-control" placeholder="Nama" name="namaMenu">
            <br>
            <input type="number" class="form-control" placeholder="Harga" name="hargaMenu">
            <br>
            {{-- <div class="form-group">
            <input type="text" class="form-control" placeholder="Deskripsi" name="deskripsiMenu" style="height: 100px; padding-bottom: 3rem; overflow-y: auto;">
            </div> --}}
            <div class="form-group">
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Deskripsi" name="deskripsiMenu"></textarea>
            </div>
            <input type="hidden" name="shop_id" value="{{ $shop_id }}">
            
            
            
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

   <!-- ModalEditMenu -->
   @if (isset($menus) && !empty($menus))
    <div class="modal fade" id="modalEditMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <h3 class="heading" style="font-family: 'Bodoni Svtytwo SC ITC TT Book', serif;">Edit Menu</h3>
          </div>

          <!--Modal Body-->
          <div class="modal-body">
            {{-- <p style="font-family: Verdana, Geneva, Tahoma, sans-serif">Masukkan Jumlah</p> --}}
            <form id="EditShopForm" action="/menu/edit" method="POST">
              @csrf
              @method('post')
              <input type="text" class="form-control" placeholder="Nama" name="namaMenu" id="oldNamaMenu" value="{{ $menu['namaMenu'] }}">
              <br>
              <input type="number" class="form-control" placeholder="Harga" name="hargaMenu" id="oldHargaMenu" value="{{ $menu['hargaMenu'] }}">
              <br>
              <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Deskripsi" name="deskripsiMenu" id="oldDeskripsiMenu" value="{{ $menu['deskripsiMenu'] }}"></textarea>
              </div>
              
              <label for="stokMenu">Tambah Stok</label>
              <input type="number" class="form-control" placeholder="stokMenu" name="stokMenu" id="oldStokMenu" value="0">

              <input type="hidden" name="id" id="idMenu" value="{{ $menu['id'] }}"">            
              
              
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


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function(){
      $('#modalEditMenu').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var namaMenu = button.data('nama-menu'); // Ambil nilai nama toko dari atribut data
        var hargaMenu = button.data('harga-menu'); 
        var deskripsiMenu = button.data('deskripsi-menu');
        var idMenu = button.data('id-menu'); 
        var modal = $(this);
        // modal.find('.modal-body #oldNamaToko').val(namaToko); // Isi nilai nama toko ke dalam input dalam modal
        modal.find('#oldNamaMenu').val(namaMenu);
        modal.find('#oldHargaMenu').val(hargaMenu);
        modal.find('#oldDeskripsiMenu').val(deskripsiMenu);  
        modal.find('#idMenu').val(idMenu); 
      });
    });
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
    });
  });
</script>
@endsection