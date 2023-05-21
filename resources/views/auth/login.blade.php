@extends('layouts.app')
@section('login')
    <div class="login-page">
        <div class="login-box">
            <div class="card card-outline card-maroon">
                <div class="card-header text-center">
                    <a href="#" class="h1">{{ env('APP_NAME') }}</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Masuk</p>
                    <form action="{{ route('login.store') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email" name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn bg-maroon btn-block">Masuk</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
