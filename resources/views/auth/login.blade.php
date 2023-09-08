<x-laravel-ui-adminlte::adminlte-layout>

    @if (Session::has( 'error' ))
        <div class="alert alert-danger">
            {{ Session::get( 'error' ) }}
        </div>
    @endif
    @if (Session::has( 'success' ))
        <div class="alert alert-success">
            {{ Session::get( 'success' ) }}
        </div>
    @endif
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
               <b>{{ config('app.name') }}</b>
            </div>
            <!-- /.login-logo -->

            <!-- /.login-box-body -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form method="post" action="">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                                class="form-control @error('email') is-invalid @enderror">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" placeholder="Password"
                                class="form-control @error('password') is-invalid @enderror">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="col-md-12">
                                {!! NoCaptcha::display() !!}
                                {!! NoCaptcha::renderJs() !!}
                            </div>
                            @error('g-recaptcha-response')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <p class="mb-0">
                                    <a href="{{ url('register') }}" class="text-center">Register a new membership</a>
                                </p>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>

        </div>
        <!-- /.login-box -->
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
