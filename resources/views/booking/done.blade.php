
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
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/booking')}}">Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/processbooking')}}">Process</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Done</a>
                        </li>
                    </ul>
                    <div class="row m-3 d-flex justify-content-between">
                        <h4 class="mt-3"><strong>Done</strong></h4><br>
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
                        <div class="row center">
                            <table class="table w-100">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th scope="col">KODE</th>
                                        <th scope="col">CUSTOMER</th>
                                        <th scope="col">TIPE KAMAR</th>
                                        <th scope="col">CHECKIN</th>
                                        <th scope="col">CHECKOUT</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $i = $datas->firstItem(); ?>
                                    @forelse($datas as $data)
                                        <tr>
                                            <th>{{$data->kode}}</th>
                                            <th>{{$data->name}}</th>
                                            <th>{{$data->type_room}}</th>
                                            <th>{{$data->checkin}}</th>
                                            <th>{{$data->checkout}}</th>
                                            <th>{{$data->status}}</th>
                                            <th>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <div>
                                                        <a href="{{route('booking.edit', ['booking'=> $data->kode]) }}" class="btn btn-sm btn-outline-dark">
                                                            <span data-feather="eye"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            No data found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
