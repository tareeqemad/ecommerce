@extends('layouts.dashboard.auth')

@section('content')
    <p class="login-box-msg">تسجيل الدخول لمواصلة العمل</p>

    @if(Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('error_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form method="POST" action="{{ url('/admin') }}">
        @csrf
        <div class="input-group mb-3">
            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الاكتروني" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
            <div class="input-group-append">
                <span class="fa fa-envelope input-group-text"></span>
            </div>
        </div>

        <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="كلمة المرور">
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    {{ __('Login') }}
                </button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif
@endsection
