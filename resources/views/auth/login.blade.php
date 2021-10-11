
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

        <title>Login Hotel App</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    </head>

    <body class="text-center">
        <form class="form-signin" method="POST" action="{{ route('login') }}">
            @csrf
            <img class="mb-4" src="https://dansmultipro.com/wp-content/uploads/2020/03/logo_web_header-810x180-1.png" alt="" width="100%" height="72">
            <!-- <h1 class="h3 mb-3 font-weight-normal">Hotel App</h1> -->
            <!-- email -->
            <label for="inputEmail" class="sr-only">Email address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!-- password -->
            <label for="inputPassword" class="sr-only">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!-- submit -->
            <button type="submit" class="btn btn-lg btn-dark btn-block">
                {{ __('Login') }}
            </button>
            <div class="row">
                <div class="col-md-6">
                    
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
                <div class="col-md-6">
                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('| Register') }}</a>
                    @endif
                </div>
            </div>
            
        </form>
    </body>
</html>