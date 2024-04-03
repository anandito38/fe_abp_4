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
            <a data-toggle="modal" data-target="#modalTambahMenu">
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
  <div class="modal fade" id="modalTambahMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
          <input type="hidden" name="user_id" value="">
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
</div>
<!-- EndModal -->
@endsection