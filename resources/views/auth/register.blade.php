@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-center items-center">
    <div class="col-md-8 w-1/2">
        <div class="card">
            <div class="text-lg mb-5 border-b-2 border-fuchsia-600 -mx-5">
                <div class="px-6 pb-2">
                    {{ __('Register') }}
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" class="w-full max-w-xl">
                    @csrf

                    <div class="login-content">
                        <div class="md:w-1/2">
                            <label for="name" class="login-label">{{ __('Name') }}</label>
                        </div>
                        

                        <div class="md:w-2/3">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror login-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="login-content">
                        <div class="md:w-1/2">
                            <label for="email" class="login-label">{{ __('E-Mail Address') }}</label>
                        </div>
                        

                        <div class="md:w-2/3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror login-input" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="login-content">
                        <div class="md:w-1/2">
                            <label for="password" class="login-label">{{ __('Password') }}</label>
                        </div>
                        

                        <div class="md:w-2/3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror login-input" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="login-content">
                        <div class="md:w-1/2">
                            <label for="password-confirm" class="login-label">{{ __('Confirm Password') }}</label>
                        </div>
                        

                        <div class="md:w-2/3">
                            <input id="password-confirm" type="password" class="login-input" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="md:flex md:items-center">
                        <div class="md:w-1/2"></div>
                        <div class="md:w2/3">
                            <button type="submit" class="btn btn-primary btn-blue">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
