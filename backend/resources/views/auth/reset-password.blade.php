@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.store') }}">
                            {{-- @method('PUT') --}}
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}" />

                            <div class="form-group row my-3">
                                <label for="email" class="col-lg-4 col-form-label text-lg-right">
                                    {{ __('E-Mail Address') }}
                                </label>

                                <div class="col-lg-6">
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" autocomplete="email" autofocus />

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="password" class="col-lg-4 col-form-label text-lg-right">
                                    {{ __('Password') }}
                                </label>

                                <div class="col-lg-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password" />

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="password-confirm" class="col-lg-4 col-form-label text-lg-right">
                                    {{ __('Confirm Password') }}
                                </label>

                                <div class="col-lg-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password" />
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-lg-6 offset-lg-4">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Reset Password') }}
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
