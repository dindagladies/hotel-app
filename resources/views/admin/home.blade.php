@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row m-3 d-flex justify-content-between">
                        <h4><strong>Dashboard</strong></h4><br>
                    </div>
                    <div class="row ml-3">Welcome to Dashboard Admin</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
