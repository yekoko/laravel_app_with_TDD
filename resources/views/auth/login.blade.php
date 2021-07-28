@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-center items-center">
    <div class="col-md-8 w-1/2">
        <div class="card">
            <div class="text-lg mb-5 border-b-2 border-fuchsia-600 -mx-5">
                <div class="px-6 pb-2">
                    {{ __('Login') }}
                </div>
            </div>

            <div class="card-body">
                <form method="POST" class="w-full max-w-xl" action="{{ route('login') }}">
                    @csrf

                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/2">
                            <label for="email" class="login-label">{{ __('E-Mail Address') }}</label>
                        </div>

                        <div class="md:w-2/3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror login-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">

                        <div class="md:w-1/2">
                            <label for="password" class="login-label">{{ __('Password') }}</label>
                        </div>

                        <div class="md:w-2/3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror login-input" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/2"></div>
                        <label class="md:w-2/3 block text-gray-500">
                          <input class="mr-2 leading-tight" type="checkbox">
                          <span class="text-sm ">
                            {{ __('Remember Me') }}
                          </span>
                        </label>
                         
                    </div>

                    <div class="md:flex md:items-center">
                        <div class="md:w-1/2"></div>
                        <div class="md:w-2/3 ">
                            <button type="submit" class="btn btn-primary btn-blue">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link px-6 text-sm text-blue-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
