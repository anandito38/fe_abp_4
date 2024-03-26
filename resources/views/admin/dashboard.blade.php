@extends('layout.layout-panel')
@section('panel-content')

@if(Session::has('userInfo'))
    @php
        $data = Session::get('userInfo');
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h3 mb-4 text-gray-800 bold-text center">Selamat Datang di Telyu Canteen Panel</h1>
                <div class="card mb-4 py-3 border-bottom-primary">
                    <div class="card-body black-text">
                        <p>{{ $data['data']['fullName'] }}</p>
                        <p>{{ $data['data']['nickname'] }}</p>
                        <p>{{ $data['data']['role'] }}</p>
                        <p>{{ $data['data']['status'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
