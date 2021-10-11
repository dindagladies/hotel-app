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
                    <div class="row m-3 d-flex justify-content-between">
                        <div class="row">
                            <a href="{{ route('transaction.index')}}" data-inline="true" class="btn btn-sm btn-dark" style="padding:10px; margin:4px;"><span data-feather="arrow-left">Add</span></a>
                            <h4 class="mt-3 pl-3"><strong>Transaksi</strong></h4><br>
                        </div>
                        @if($data->status == 'Lunas')
                            <a href="{{ url('/transaction/invoice', ['transaction'=> $data->id])}}" target="_blank" data-inline="true" class="btn btn-sm btn-dark" style="padding:10px; margin:4px;"><span data-feather="download">Download</span></a>
                        @else
                            <a href="{{ url('/transaction/invoice', ['transaction'=> $data->id])}}" target="_blank" data-inline="true" class="btn btn-sm btn-dark" style="padding:10px; margin:4px;"><span data-feather="download">Download</span></a>
                        @endif
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
                                <form method="post" action="{{route('transaction.update', ['transaction'=> $data->id])}}" enctype="multipart/form-data">
                                @method('PUT')
                                @else
                                <form method="post" action="{{route('transaction.store')}}">
                                @endif
                                    @csrf
                                    <div class="p-4 mb-4">
                                        <h5 class="mb-4">Data Kamar</h5>
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
                                                <label for="">{{$room->price}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 mb-4">
                                        <h5 class="mb-4">Data Customer</h5>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Nama</strong></label>
                                            <div class="col-sm-10">
                                                <label for="">{{$customer->name}}</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Email</strong></label>
                                            <div class="col-sm-10">
                                                <label for="">{{$customer->email}}</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Nomor Tlf</strong></label>
                                            <div class="col-sm-10">
                                                <label for="">{{$customer->phone}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 mb-4">
                                        <h5 class="mb-4">Data Booking</h5>
                                        <!-- checkin -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Checkin</label>
                                            <div class="col-sm-10">
                                                <div class="col-sm-10">
                                                    <label for="">{{$booking->checkin}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- checkout -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Checkout</label>
                                            <div class="col-sm-10">
                                                <div class="col-sm-10">
                                                    <label for="">{{$booking->checkout}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- total -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Total</label>
                                            <div class="col-sm-10">
                                                <div class="col-sm-10">
                                                    <label for="">{{$booking->total}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Status -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Status Booking</label>
                                            <div class="col-sm-10">
                                                <div class="col-sm-10">
                                                    <label for="">{{$booking->status}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- status pembayaran -->
                                    <div class="p-4 mb-4">
                                        <h5 class="mb-4">Data Transaksi</h5>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Total Biaya</strong></label>
                                            <div class="col-sm-10">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">{{$data->total}}</label>
                                            </div>
                                        </div>
                                        @if($role == 'Admin')
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Status</strong></label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="status" id="exampleFormControlSelect1">
                                                    <option value="">Enter Status</option>
                                                    <option value="Pending" {{ ($data->status ?? '') == "Pending" ? 'selected':'' }} > Pending </option>
                                                    <option value="Process" {{ ($data->status ?? '') == "Process" ? 'selected':'' }} > Process </option>
                                                    <option value="Lunas" {{ ($data->status ?? '') == "Lunas" ? 'selected':'' }} > Lunas </option>
                                                    <option value="Cancel" {{ ($data->status ?? '') == "Cancel" ? 'selected':'' }} > Cancel </option>
                                                </select>
                                            </div>
                                        </div>
                                        @else
                                            <input class="form-group" name="status" type="hidden" value="Process">
                                        @endif
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><strong>Bukti Pembayaran</strong></label>
                                            <div class="col-sm-10">
                                                @if(!empty($data->file))
                                                    <img class="p-3" style="width:50%" src="{{$data->file ? \Illuminate\Support\Facades\Storage::url($data->file) : ''}}" alt="">
                                                @endif
                                                <input class="form-group" name="bukti" type="file" id="file">
                                                @if($role == 'User' && $data->status != 'Lunas')
                                                
                                                @endif
                                            </div>
                                        </div>
                                        <!-- submit -->
                                        @if($data->status == 'Lunas')
                                            
                                        @else
                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-md btn-success" type="submit" name="submit" value="Submit" style="padding:10px; margin:4px">
                                        </div>
                                        @endif
                                    </div>
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
