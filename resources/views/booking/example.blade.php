@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-3 d-flex justify-content-left">
                        <a href="{{ route('booking.index')}}" data-inline="true" class="btn btn-sm btn-dark" style="padding:10px; margin:4px;"><span data-feather="arrow-left">Add</span></a>
                        <h4 class="mt-3 pl-3"><strong>Tambah Booking</strong></h4><br>
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
                                <div class="p-4 mb-4">
                                    @if($title == 'Edit')
                                        <form method="post" action="{{route('booking.update', ['booking'=> $data->id])}}" enctype="multipart/form-data">
                                        @method('PUT')
                                    @else
                                        <form method="post" action="{{route('booking.store')}}" enctype="multipart/form-data">
                                    @endif
                                        @csrf
                                        <input type="hidden" value="{{$data->id ?? ''}}" name="id">
                                        <!-- name -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" id="" placeholder="Enter Nama Room" value="{{$data->name ?? ''}}">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Tipe Bed -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Bed</label>
                                            <div class="col-sm-10">
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="type_bed" id="exampleFormControlSelect1">
                                                        <option value="">Enter Jenis Kamar</option>
                                                        <option value="">Standard</option>
                                                        <option value="">Superior</option>
                                                        <option value="">Deluxe</option>
                                                    </select>
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                @if ($errors->has('type_bed'))
                                                    <span class="text-danger">{{ $errors->first('type_bed') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- price -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Harga</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="price" class="form-control" id="" placeholder="Enter Harga" value="{{$data->price ?? ''}}">
                                                @if ($errors->has('price'))
                                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Description  -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="description" class="form-control" id="" placeholder="Enter Deskripsi" value="{{$data->description ?? ''}}">
                                                @if ($errors->has('description'))
                                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- submit -->
                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-md btn-dark" type="submit" name="submit" value="Submit" style="padding:10px; margin:4px">
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
</div>
@endsection