@extends('layouts.app')
@section('nav')
    @include('layouts.nav-Admin')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-3 d-flex justify-content-between">
                        <div class="row">
                            <a href="{{ route('room.index')}}" data-inline="true" class="btn btn-sm btn-dark" style="padding:10px; margin:4px;"><span data-feather="arrow-left">Add</span></a>
                            <h4 class="mt-3 pl-3"><strong>{{$title}} Room</strong></h4><br>
                        </div>
                        <div class="row">
                            <a href="">Data Master / </a>
                            <a href="{{url('/room')}}">&nbsp Data Room / </a>
                            <p>&nbsp {{$title}} Room</p>
                        </div>
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
                                        <form method="post" action="{{route('room.update', ['room'=> $data->id])}}" enctype="multipart/form-data">
                                        @method('PUT')
                                    @else
                                        <form method="post" action="{{route('room.store')}}">
                                    @endif
                                        @csrf
                                        <input type="hidden" value="{{$data->id ?? old('id') }}" name="id">
                                        <!-- name -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Kamar</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="type_room" id="exampleFormControlSelect1">
                                                    <option value="">Enter Tipe Kamar</option>
                                                    <option value="Standard" {{ ($data->type_room ?? old('type_room') ) == "Standard" ? 'selected':'' }}>Standard</option>
                                                    <option value="Superior" {{ ($data->type_room ?? old('type_room') ) == "Superior" ? 'selected':'' }}>Superior</option>
                                                    <option value="Deluxe" {{ ($data->type_room ?? old('type_room') ) == "Deluxe" ? 'selected':'' }}>Deluxe</option>
                                                </select>
                                                @if ($errors->has('type_room'))
                                                    <span class="text-danger">{{ $errors->first('type_room') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Tipe Bed -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Kasur</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="type_bed" id="exampleFormControlSelect1">
                                                    <option value="">Enter Tipe Kasur</option>
                                                    <option value="Single" {{ ($data->type_bed ?? old('type_bed') ) == "Single" ? 'selected':'' }}>Single</option>
                                                    <option value="Queen" {{ ($data->type_bed ?? old('type_bed') ) == "Queen" ? 'selected':'' }}>Queen</option>
                                                    <option value="King" {{ ($data->type_bed ?? old('type_bed') ) == "King" ? 'selected':'' }}>King</option>
                                                </select>
                                                @if ($errors->has('type_bed'))
                                                    <span class="text-danger">{{ $errors->first('type_bed') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- total kamar -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Total Kamar</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="total" class="form-control" id="" placeholder="Enter Total Kamar" value="{{$data->total ?? old('total') }}">
                                                @if ($errors->has('total'))
                                                    <span class="text-danger">{{ $errors->first('total') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- price -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Harga</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="price" class="form-control" id="" placeholder="Enter Harga" value="{{$data->price ?? old('price') }}">
                                                @if ($errors->has('price'))
                                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Description  -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="description" class="form-control" id="" placeholder="Enter Deskripsi" value="{{$data->description ?? old('description') }}">
                                                @if ($errors->has('description'))
                                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- submit -->
                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-md btn-success" type="submit" name="submit" value="Submit" style="padding:10px; margin:4px">
                                        </div>
                                    </form>
                                </div>
                                <!-- <div class="p-4 mb-4">
                                    <table class="table w-100">
                                        <thead class="text-center">
                                            <tr>
                                                <th scope="col">NOMOR RUANG</th>
                                                <th scope="col">STATUS</th>
                                                <th scope="col">#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <th>201</th>
                                                <th>Available</th>
                                                <th>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <div>
                                                            <form action="#" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Apakah anda yakin akan menghapus')" ><span data-feather="trash"></span></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th><input class="form-control" type="text" placeholder="000"></th>
                                                <th>
                                                    <select class="form-control" name="type_bed" id="exampleFormControlSelect1">
                                                        <option value="">Available</option>
                                                        <option value="">Booked</option>
                                                    </select>
                                                </th>
                                                <th>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <div>
                                                            <a href="#" class="btn btn-sm btn-dark">
                                                                <span data-feather="plus"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table><br>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
