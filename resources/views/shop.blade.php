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
        {{-- @foreach ($shops as $shop)
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <a href="/menu/category/byShop?id_shop={{ $shop->id }}" class="shop-link" >
              @method('post')
              <div class="img-box">
                <img src="images/r1.jpg" class="box-img" alt="">
              </div>
            </a>
            <div class="detail-box">
              <h4>
                {{ $shop->nomorToko }}.
                {{ $shop->namaToko }}
              </h4>
            </div>
          </div>
        </div>
        @endforeach --}}
        @foreach ($shops as $shop)
          <div class="col-sm-6 col-md-4 mx-auto">
            <div class="box">
              <form action="/menu/byshop" method="GET">
                @csrf
                @method('get')
                <div class="img-box">
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <button type="submit" class="shop-link">
                      <img src="images/r1.jpg" class="box-img" alt="">
                    </button>
                </div>
              </form>
              <div class="detail-box">
                <h4>
                  {{ $shop->nomorToko }}.
                  {{ $shop->namaToko }}
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
@endsection