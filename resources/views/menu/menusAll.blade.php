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
        <h2>
          Menu Kantin 
        </h2>
      </div>
      <div class="row">
        @foreach ($menus as $menu)
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <a  href="/shop/{{ $menu['shop_id'] }}">
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
                {{ $menu['deskripsiMenu'] }} dari
                {{ $menu['shop_namaToko'] }}
              </h6>
              <a href="/shop/{{ $menu['shop_id'] }}">Go</a>
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
