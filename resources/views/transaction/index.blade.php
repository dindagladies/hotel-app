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
                        <h4 class="mt-3"><strong>Transaksi</strong></h4><br>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row ml-3">
                        <div class="col-md-12">
                        <form action="{{action('RoomController@search') }}" method="GET">
                            @csrf
                            <div class="form-group row">
                                <input type="text" class="form-control col-3 mr-3" name="cari" id="" placeholder="Cari">
                                <input class="form-group btn btn-sm btn-dark mr-2" type="submit" value="Search">
                                <input class="form-group btn btn-sm btn-light" type="submit" value="Reset">
                            </div>
                        </form>
                        </div>
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
                    <table class="table w-100">
                        <thead class="bg-light text-center">
                            <tr>
                                <th scope="col">KODE TRANSAKSI</th>
                                <th scope="col">KODE BOOKING</th>
                                <th scope="col">TOTAL</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php $i = $datas->firstItem(); ?>
                            @forelse($datas as $data)
                            <tr>
                                <th>{{$data->id}}</th>
                                <th>{{$data->booking}}</th>
                                <th>
                                    {{$data->total}}
                                </th>
                                <th>
                                    {{$data->status}}
                                </th>
                                <th>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <div>
                                        <a href="{{route('transaction.edit', ['transaction'=> $data->id]) }}" class="btn btn-sm btn-success">
                                                <span data-feather="edit"></span>
                                            </a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No data found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection