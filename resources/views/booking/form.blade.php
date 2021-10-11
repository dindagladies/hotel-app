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
                    <div class="row m-3 d-flex justify-content-left">
                        <a href="{{ url('/'. $url)}}" data-inline="true" class="btn btn-sm btn-dark" style="padding:10px; margin:4px;"><span data-feather="arrow-left">Back</span></a>
                        <h4 class="mt-3 pl-3"><strong>Booking</strong></h4><br>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- form -->
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                @if($title == 'Edit')
                                <form method="post" action="{{route('booking.update', ['booking'=> $data->id])}}" enctype="multipart/form-data">
                                @method('PUT')
                                @else
                                <form method="post" action="{{route('booking.store')}}">
                                @endif
                                    @csrf
                                    <div class="p-4 mb-4">
                                        <h5 class="mb-4">Data Kamar</h5>
                                        <input type="hidden" name="room" id="" value="{{$room->id}}">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Tipe Kamar</strong></label>
                                            <div class="col-sm-10">
                                                <label for="">{{$room->type_room}}</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Tipe Kasur</strong></label>
                                            <div class="col-sm-10">
                                                <label for="">{{$room->description}}</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Harga</strong></label>
                                            <div class="col-sm-10">
                                                <input type="hidden" value="{{$room->price}}" name="price">
                                                <label for="">{{$room->price}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 mb-4">
                                        <h5 class="mb-4">Data Pemesan</h5>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Nama</strong></label>
                                            <div class="col-sm-10">
                                                @if($title == 'Tambah')
                                                    <select class="form-control" name="data_user" id="exampleFormControlSelect1">
                                                        <option value="">Enter Data Pemesan</option>
                                                        @foreach($customers as $customer)
                                                            <option value="{{$customer->id}}" {{ ($data->data_user ?? old('data_user')) == $customer->id ? 'selected':'' }} > {{$customer->name}} </option>
                                                        @endforeach
                                                    </select>
                                                    <a class="ml-2" href="{{route('datauser.create')}}">Tambah</a>
                                                    @if ($errors->has('data_user'))
                                                        <span class="text-danger">{{ $errors->first('data_user') }}</span>
                                                    @endif
                                                @else
                                                    <label >{{$customer->name}}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 mb-4">
                                        <h5 class="mb-4">Data Booking</h5>
                                        <!-- checkin -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Checkin</label>
                                            <div class="col-sm-10">
                                                <input type="date" name="checkin" class="form-control" id="" placeholder="Enter Tanggal Chekin" value="{{$data->checkin ?? old('checkin')}}">
                                                @if ($errors->has('checkin'))
                                                    <span class="text-danger">{{ $errors->first('checkin') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- checkout -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Checkout</label>
                                            <div class="col-sm-10">
                                                <input type="date" name="checkout" class="form-control" id="" placeholder="Enter Tanggal Chekout" value="{{$data->checkout ?? old('checkout')}}">
                                                @if ($errors->has('checkout'))
                                                    <span class="text-danger">{{ $errors->first('checkout') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="hidden" name="status" class="form-control" id="" placeholder="{{$data->status ?? old('status')}}" value="Process" readonly>
                                    </div>
                                    @if($title == 'Edit')
                                    <div class="p-4 mb-4">
                                        <h5 class="mb-4">Data Transaksi</h5>
                                        
                                        <input type="hidden" value="{{$data->id ?? old('id')}}" name="id">
                                        <!-- total biaya -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Total Biaya</strong></label>
                                            <div class="col-sm-10">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">{{$transaction->total}}</label>
                                            </div>
                                        </div>
                                        <!-- status pembayaran -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Status Pembayaran</strong></label>
                                            <div class="col-sm-10">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">{{$transaction->status}}</label>
                                            </div>
                                        </div>
                                        <!-- bukti pembayaran -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Bukti Pembayaran</strong></label>
                                            <div class="col-sm-10">
                                                @if(!empty($transaction->file))
                                                    <img class="p-3" style="width:50%" src="{{$transaction->file ? \Illuminate\Support\Facades\Storage::url($transaction->file) : ''}}" alt="">
                                                @else
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">{{$transaction->status}}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="p-4" mb-4>
                                            <!-- submit -->
                                            <div class="d-flex justify-content-end">
                                            <input class="btn btn-md btn-success" type="submit" name="submit" value="Submit" style="padding:10px; margin:4px">
                                        </div>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
