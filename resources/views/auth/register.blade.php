@extends('layouts.app')

@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Register</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <h2 class="mt-5"><b>Signup Here !</b></h2>
                <form action="{{route('client.register')}}" method="post" id="myform">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Post Title">{{ __('First Name') }}<span class="required">*</span></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"  placeholder="First Name" value="{{ old('first_name') }}">
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Post Title">{{ __('Last Name') }}<span class="required">*</span></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"  placeholder="Last Name" value="{{ old('last_name') }}">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="Post Title">{{ __('Contact Number') }}<span class="required">*</span></label>
                                    <input type="number" class="form-control @error('contact') is-invalid @enderror" name="contact"   placeholder="Contact Number" value="{{ old('contact') }}">
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="Post Title">{{ __('Email') }}<span class="required">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"   placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="Post Title">{{ __('Address') }}<span class="required">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" rows="3">{{ old('address') }}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn" style="background-color: #da4a0d;color: #fff">Register Now</button>
                    </div>
                </form>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
@endsection
