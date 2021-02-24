@extends('layouts.app')

@section('title')
    <title>Sussex Agency | Login</title>
@endsection

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="{{asset('img/login_image.jpg')}}" class="img-fluid animated" style="max-height: 140%;margin-bottom: -30%">
        </div>
        <div class="col-md-4">
            <div class="container">
                <h2  style="margin-top: 100px"><b>Login Here !</b></h2>
                <form method="POST" action="{{ route('login') }}" class="mt-5">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>E-Mail Address</label>
                                <input id="email" style="margin-top: -5px" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: -10px">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Password</label>
                                <input style="margin-top: -5px" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: -10px">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: -10px">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </div>

                                    <div class="row" style="margin-top: -15px">
                                            <a class="btn btn-link" href="{{ route('register') }}">
                                                {{ __('Register as a Client') }}
                                            </a>
                                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
