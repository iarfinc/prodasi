@extends('layouts.auth')
@section('content')
    <div class="row h-100" style="display: flex; align-items: center; justify-content: center;">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <img src="{{asset('/')}}assets/img/psd.png" alt="Logo" style=" margin-left: 60px; width: 500px; max-width: 100%; height: auto;">
                </div>
                @if (session()->has('eror'))
                    <div class="alert alert-danger">
                        {{session('eror')}}
                    </div>
                @endif
                @if (session()->has('sukses'))
                <div class="alert alert-success">
                    {{session('sukses')}}
                </div>
            @endif
            <style>
                .form-control-icon {
                    position: absolute;
                    left: 10px;
                    transform: translateY(27%);
                    color: #adb5bd;
                }
            </style>
                <form action="{{route('auth')}}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" class="form-control form-control-xl {{ $errors->first('email') != null ? 'is-invalid' : '' }}" value="{{old('email')}}" name="email" id="email" placeholder="Email">
                        @if ($errors->first('email') != null)
                        <div class="invalid-feedback">
                            {{$errors->first('email')}}
                        </div>
                        @endif
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl {{ $errors->first('password') != null ? 'is-invalid' : '' }}" name="password" id="password" placeholder="Password">
                        @if ($errors->first('password') != null)
                        <div class="invalid-feedback">
                            {{$errors->first('password')}}
                        </div>
                        @endif
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" style="background-color: #0dcaf0; border-color: #0dcaf0;">Masuk</button>
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection
