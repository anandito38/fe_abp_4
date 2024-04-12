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
              <form action="/shop/byUser/menu" method="POST">
                @csrf
                {{-- @method('get') --}}
                <div class="img-box">
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                    <img src="" class="box-img" alt="gambar shop" onerror="this.onerror=null; this.src='https://fivestar.sirv.com/example.jpg?profile=Example';">
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
                  {{ $shop['namaToko'] }}.
                  <br>
                  {{ $shop['nomorToko'] }}
                </h4>
                <h6>
                  {{ $shop['lokasiToko'] }}</h6>
              </div>
            </div>
          </div>
          @endforeach

        @endif
      </div>
      
    </div>
  </section>

  <!-- Modal -->
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
  </div>>
<!-- EndModal -->
@endsection