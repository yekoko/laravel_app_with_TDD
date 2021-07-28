@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="w-1/2">
        <div class="card">
            <div class="text-lg mb-5 border-b-2 border-fuchsia-600 -mx-5">
                <div class="px-6 pb-2">
                    {{ __('Confirm Password') }}
                </div>
            </div>

            <div class="card-body">
                {{ __('Please confirm your password before continuing.') }}

                <form method="POST" action="{{ route('password.confirm') }}" class="w-full max-w-xl">
                    @csrf

                    <div class="login-content">
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

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Confirm Password') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
