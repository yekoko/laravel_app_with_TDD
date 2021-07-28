@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="w-1/2">
        <div class="card">
            <div class="text-lg mb-5 border-b-2 border-fuchsia-600 -mx-5">
                <div class="px-6 pb-2">
                    {{ __('Reset Password') }}
                </div>
            </div>
            

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="w-full max-w-xl">
                    @csrf

                    <div class="login-content">
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

                    <div class="md:flex md:items-center">
                        <div class="md:w-1/2"></div>
                        <div class="md:w-2/3">
                            <button type="submit" class="btn btn-primary btn-blue">
                                {{ __('Send Password Reset Link') }}
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
