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
                            <a href="{{ route('datauser.index')}}" data-inline="true" class="btn btn-sm btn-dark" style="padding:10px; margin:4px;"><span data-feather="arrow-left">Add</span></a>
                            <h4 class="mt-3 pl-3"><strong>{{$title}} Pemesan</strong></h4><br>
                        </div>
                        <div class="row">
                            <a href="">Data Master / </a>
                            <a href="{{url('datauser')}}">&nbsp Data Pemesan / </a>
                            <p>&nbsp {{$title}} </p>
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
                                        <form method="post" action="{{route('datauser.update', ['datauser'=> $data->id])}}" enctype="multipart/form-data">
                                        @method('PUT')
                                    @else
                                        <form method="post" action="{{route('datauser.store')}}">
                                    @endif
                                        @csrf
                                        <input type="hidden" value="{{$data->id ?? ''}}" name="id">
                                        <!-- name -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" id="" placeholder="Enter Nama" value="{{$data->name ?? old('name')}}">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- TTL -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                            <div class="col-sm-10">
                                                <input type="date" name="birth_date" class="form-control" id="" placeholder="Enter Tanggal Lahir" value="{{$data->birth_date ?? old('birth_date')}}">
                                                @if ($errors->has('birth_date'))
                                                    <span class="text-danger">{{ $errors->first('birth_date') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- email -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" class="form-control" id="" placeholder="Enter Email" value="{{$data->email ?? old('email')}}">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- phone -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Telefon</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="phone" class="form-control" id="" placeholder="Enter Nomor Telefon" value="{{$data->phone ?? old('phone')}}">
                                                @if ($errors->has('phone'))
                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- submit -->
                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-md btn-success" type="submit" name="submit" value="Submit" style="padding:10px; margin:4px">
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
