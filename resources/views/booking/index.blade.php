
@extends('layouts.app')
@section('nav')
    @include('layouts.nav-'. $role)
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($role == 'Admin')
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/processbooking')}}">Process</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/donebooking')}}">Done</a>
                        </li>
                    </ul>
                    @else($role == 'User')
                    
                    @endif
                    <div class="row m-3 d-flex justify-content-between">
                        <h4 class="mt-3"><strong>Booking</strong></h4><br>
                    </div>
                    @if ($message = session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = session('error'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = session('warning'))
                        <div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="row ml-3">
                        <div class="col-md-12">
                        <form action="{{action('BookingController@search') }}" method="GET">
                            @csrf
                            <div class="form-group row">
                                <input type="text" class="form-control col-3 mr-3" name="cari" id="" placeholder="Cari">
                                <input class="form-group btn btn-sm btn-dark mr-2" type="submit" value="Search">
                                <input class="form-group btn btn-sm btn-light" type="submit" value="Reset">
                            </div>
                        </form>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row center ml-5">
                            @forelse($datas as $data)
                            <div class="col-4 card-deck mb-3 text-center">
                                <div class="card mb-4 box-shadow">
                                    <div class="card-header">
                                        <h4 class="my-0 font-weight-normal">{{$data->type_room}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="card-title pricing-card-title">Rp. {{$data->price}},-<small class="text-muted"></small></h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>{{$data->description}}</li>
                                        </ul>
                                        <a type="button" href="{{route('booking.show' , ['booking' => $data->id] ) }}" class="btn btn-lg btn-block btn-outline-primary">Booking</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <p class="ml-3">No data found</p>
                            @endforelse
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
