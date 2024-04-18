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
    <d class="container" style="margin-bottom: 70px">
      <div class="heading_container heading_center">
        <h2>Cart</h2>
      </div>
      <div class="table-responsive" style="padding-left: 4rem; padding-right: 4rem;">
        <table class="table table-bordered table-striped" style="margin-top: 2rem; margin-left: auto; margin-right: auto;">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th class="col-auto" style="width: 5rem">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $cart['Menu']['namaMenu'] }}</td>
                        <td>{{ $cart['Menu']['hargaMenu'] }}</td>
                        <td>{{ $cart['quantity'] }}</td>
                        <td class="col-auto">
                            <div class="d-flex">
                                <a href="#" class="btn btn-warning mr-2">Edit</a>
                                <a href="#" class="btn btn-danger mr-2">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
    
    
    
      
      
      {{-- <div class="btn-box">
        <a href="">
          Order Now
        </a>
      </div> --}}
    </div>
  </section>


<!-- Modal -->
  {{-- <div class="modal fade" id="modalTambahMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
  </div> --}}
<!-- EndModal -->
@endsection
