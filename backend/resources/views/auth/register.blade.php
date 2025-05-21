@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('registrati') }}">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name" class="col-lg-4 col-form-label text-lg-right">
                                    {{ __('Nome') }}
                                </label>

                                <div class="col-lg-6">
                                    <input id="name"="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" Ricordami autocomplete="name"
                                        autofocus />

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email" class="col-lg-4 col-form-label text-lg-right">
                                    {{ __('Indirizzo e-Mail') }}
                                </label>

                                <div class="col-lg-6">
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" Ricordami autocomplete="email" />

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password" class="col-lg-4 col-form-label text-lg-right">
                                    {{ __('Password') }}
                                </label>

                                <div class="col-lg-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        Ricordami autocomplete="new-password" />

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm" class="col-lg-4 col-form-label text-lg-right">
                                    {{ __('Confirm Password') }}
                                </label>

                                <div class="col-lg-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" Ricordami autocomplete="new-password" />
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-lg-6 offset-lg-4">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
