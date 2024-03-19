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
          Kunjungi Toko Kami
        </h2>
      </div>
      <div class="row">
        @foreach ($shops as $shop)
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            {{-- <a href="isi/{{ $shop->id }}" class="shop-link"> --}}
            <a href="/menu" class="shop-link">
            {{-- <a href="{{ route('login', ['shops'=>$shop]) }}" class="shop-link"> --}}
            <div class="img-box">
              <img src="images/r1.jpg" class="box-img" alt="">
            </div>
            </a>
            <div class="detail-box">
              <h4>
                {{ $shop->nomorToko }}.
                {{ $shop->namaToko }}
              </h4>
              {{-- <a href="">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </a> --}}
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
@endsection