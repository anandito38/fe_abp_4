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
          @if (isset($menus))
            {{ $menus[0]['namaToko'] }}
          @endif
        </h2>
      </div>
      <div class="row">
        @foreach ($menus as $menu)
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <a  data-toggle="modal" data-target="#modalTambahMenu">
              <div class="img-box">
                <img src="{{ asset('images/n1.jpg')}}" class="box-img" alt="">
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
