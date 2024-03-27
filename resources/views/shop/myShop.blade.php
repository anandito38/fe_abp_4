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
          @if (isset($menus))
            {{ $menus[0]['namaToko'] }}
          @endif
        </h2>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-4 mx-auto" style="display: flex;flex-direction: column; align-items: center; justify-content: center">
          
            <a  data-toggle="modal" data-target="#modalTambahMenu">
              <div class="detail-box" style="text-align: center">
                <i class="fa fa-plus" aria-hidden="true">
                </i>
                <h4>
                  Tambah
                  <br>
                  Menu
                </h4>
              </div>
            </a>
          
        </div>


        {{-- ini coba doang komenin aja --}}
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <a >
              <div class="img-box">
                {{-- <img src="" class="box-img" alt="" onerror="this.onerror=null; this.src='https://demofree.sirv.com/nope-not-here.jpg?w=2000';"> --}}
                <img src="{{ asset('images/n1.jpg')}}" class="box-img" alt="" onerror="this.onerror=null; this.src='https://demofree.sirv.com/nope-not-here.jpg?w=2000';">
              </div>
            </a>
            <div class="detail-box">
              <h4>
                sada
                <br>
                ada
              </h4>
              <h6>
                adas
            </div>
          </div>
        </div>

        @php
          dd($menus)
        @endphp
        @if (isset($menus==null))
          @foreach ($menus as $menu)
          <div class="col-sm-6 col-md-4 mx-auto">
            <div class="box">
              <a >
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
                  {{ $menu['deskripsiMenu'] }}</h6>
              </div>
            </div>
          </div>
          @endforeach
        @else
          <p>menu belum ada</p>
        @endif
      </div>
      {{-- <div class="btn-box">
        <a href="">
          Order Now
        </a>
      </div> --}}
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
</div>
<!-- EndModal -->
@endsection