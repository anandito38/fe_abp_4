@extends('layout.app-master')

@section('content')
  {{-- @php
    dd($menus)
  @endphp --}}
  <div class="hero_area">
    <!-- header section strats -->
    @include('layout.navbar')
  </div>

  <!-- section -->

  <section class="recipe_section layout_padding-top">
    <div class="container" style="margin-bottom: 70px">
      <div class="heading_container heading_center">
        <h2>Menu Pesanan</h2>
      </div>

      @if (isset($menus) && count($menus) > 0)
        <div class="table-responsive" style="padding-left: 4rem; padding-right: 4rem;">
          <table class="table table-bordered table-striped" style="margin-top: 2rem; margin-left: auto; margin-right: auto;">
              <thead>
                  <tr>
                      <th class="col-auto">Nama Menu</th>
                      <th class="col-auto" >Harga</th>
                      <th class="col-auto" >Jumlah</th>
                      
                      <th class="col-auto" style="width: 15rem">Status Makanan</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($menus as $menu)
                      <tr>
                          <td>{{ $menu['namaMenu'] }}</td>
                          <td>{{ $menu['harga'] }}</td>
                          <td>{{ $menu['banyakPesanan'] }}</td>
                          @if($menu['statusMasak'] == 'Selesai')
                            <td style="color: green">Selesai</td>
                          @else
                            <td style="color: red">Dalam proses</td>
                          @endif
                      </tr>
                  @endforeach
              </tbody>
          </table>

        </div>
        
      @else
        <div class="heading_container heading_center">
          <h4 style="margin-top: 2rem">Belum ada item ditambahkan</h4>
        </div>
      @endif
    </div>
  </section>
  


@endsection
