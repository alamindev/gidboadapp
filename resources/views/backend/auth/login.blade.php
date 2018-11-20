@extends('layouts/backend/layout') @push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/authentication.css') }}" /> 
@endpush 
@section('main-content')
<div class="authentication">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="l-detail">
                    <h1>Welcome </h1>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                    <h4 class="l-login text-center bg-info p-2 text-white">Login</h4>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group form-float {{ $errors->has('email') ? ' is-danger' : '' }}">
                            <label class="form-label  float-left">Email Or Username</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Your Email or Username">                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span> @endif
                        </div>
                        <div class="form-group form-float {{ $errors->has('password') ? ' is-danger' : '' }}">
                            <label class="form-label float-left">Password</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="Enter Your Password">                            @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span> @endif
                        </div>
                        <div class="m-t-10">
                            <input type="checkbox" id="remember" name="remember" {{ old( 'remember')? 'checked' : '' }} class="filled-in chk-col-cyan">
                            <label for="remember">Remember Me</label>
                        </div>

                        <input type="submit" class="btn btn-raised waves-effect bg-red w-50" value="LOGIN">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection