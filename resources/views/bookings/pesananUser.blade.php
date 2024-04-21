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
        <h2>Pesanan</h2>
      </div>

      @if (isset($invoices) && count($invoices) > 0)
        @foreach($invoices as $invoice)
    
          <div class="card w-80 mt-4" style="border: 1px solid black;">
            <div class="card-body">
              <h5 class="card-title">Id booking : {{ $invoice['booking_id']}}</h5>
              @if($invoice['statusLengkap'] == 'Selesai')
                <p class="card-text" style="margin-bottom: 0.001rem;color: green">Status pesanan : Selesai </p>
              @else
              <p class="card-text" style="margin-bottom: 0.001rem;color: red">Status pesanan : Dalam proses </p>
              @endif
              <p class="card-text" style="margin-bottom: 0.001rem">Total harga : {{ $invoice['totalHarga']}} </p>
              <p class="card-text"style="margin-bottom: 0.5rem;">Nomor meja : {{ $invoice['nomorMeja']}} </p>
              <form action="/booking/all/menu" method="POST" >
                @csrf
                <input type="hidden" name="invoice_id" value="{{ $invoice['id'] }}">
                <button type="submit" class="btn" style="border: 2px solid blue; background-color: transparent; color: blue;">Lihat Pesanan</button>
              </form>
            </div>
          </div>
          
        @endforeach
        
      @else
        <div class="heading_container heading_center">
          <h4 style="margin-top: 2rem">Belum ada item ditambahkan</h4>
        </div>
      @endif
    </div>
  </section>

@endsection
