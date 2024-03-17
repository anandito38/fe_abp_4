@extends('layout')
@section('content')

{{-- @if(Session::has('userInfo'))
    @php
        $data = Session::get('userInfo');
    @endphp --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h3 mb-4 text-gray-800 bold-text">Selamat Datang di Tel-U Cafetaria</h1>
                <div class="card mb-4 py-3 border-bottom-warning">
                    <div class="card-body black-text">
                        {{-- <p>{{ $data->getNickname() }}</p>
                        <p>{{ $data->getfullName() }}</p>
                        <p>{{ $data->getRole() }}</p> --}}
                        <p>Anandito</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- @endif
@endsection --}}
