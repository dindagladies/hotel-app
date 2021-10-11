<nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="{{ url('/booking') }}">Booking</a>
    <a class="p-2 text-dark" href="{{ url('/transaction') }}">Transaction</a>
    <div class="btn-group">
        <a href="#" class="p-2 text-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data Master</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('/datauser') }}">User</a>
            <a class="dropdown-item" href="{{ url('/room') }}">Room</a>
            <!-- <a class="dropdown-item" href="{{ url('/booking') }}">History</a> -->
        </div>
    </div>
</nav>