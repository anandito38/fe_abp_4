@extends('layout.app-master')

@section('content')

  <div class="hero_area">
    <!-- header section strats -->
    @include('layout.navbar')
  </div>


  <!-- recipe section -->

  <section class="recipe_section layout_padding-top">
    <div class="container" style="margin-bottom: 70px">
      <div class="heading_container heading_center">
        <h2>
          Menu Toko
        </h2>
      </div>
      <div class="row">
        @foreach ($menus as $menu)
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
              <a  data-toggle="modal" data-target="#modalConfirmDelete">
            <div class="img-box">
              <img src="images/about-img.jpg" class="box-img" alt="">
            </div>
            </a>
            <div class="detail-box">
              <h4>
                {{ $menu->namaMenu }}.
                <br>
                {{ $menu->hargaMenui }}
              </h4>
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
  <div class="modal fade" id="pilihMenu" tabindex="-1" aria-labelledby="pilihMenu" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

<!--Modal: modalConfirmDelete-->
  <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Tambah menu</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-times fa-4x animated rotateIn"></i>

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
<!--Modal: modalConfirmDelete-->
@endsection
