@extends('layouts.app')

@section('content')








    <div class="page login-page">
        <div class="container">
            <div class="form-outer text-center d-flex align-items-center">
                <div class="form-inner">
                    <div class="logo text-uppercase">
                        <span>Welcome TO </span>
                        <strong class="text-primary">D’ Golden Wear Store</strong>
                    </div>
                    <p>
                    </p>

                    {{--<form method="get" class="text-left form-validate">--}}
                        <form method="POST"  action="{{ route('login') }}" class="text-left form-validate" >
                            @csrf


                        <div class="form-group-material">
                            <input id="login-username" type="text" required data-msg="Please enter your username" class="input-material {{ $errors->has('email') ? ' is-invalid' : '' }}"  value="{{ old('email') }}" name="email" required autofocus >
                            <label for="login-username" class="label-material">Username</label>

                            <div>
                                @if ($errors->has('email'))
                                    <span class=" text-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group-material">
                            <input id="login-password" type="password"   required data-msg="Please enter your password"  class="input-material {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required >
                            <label for="login-password" class="label-material">Password</label>

                            <div>

                                @if ($errors->has('password'))
                                    <span class="  text-danger" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                {{--@if (Route::has('password.request'))--}}
                                    {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                        {{--{{ __('Forgot Your Password?') }}--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                            </div>
                        </div>

                        {{----}}
                        {{--<div class="form-group text-center">--}}
                            {{----}}
                            {{----}}
                            {{--<a id="login" href="index.html" class="btn btn-primary">--}}
                                {{--Login--}}
                            {{--</a>--}}

                        {{--</div>--}}
                    </form>
                </div>
                <div class="copyrights text-center">
                    <p>
                        Design by
                        <a target="_blank" href="https://bootstrapious.com" class="external">Theme</a> and developed by
                        <a target="_blank" href="http://jesuserwinsuarez.com" class="external">Jesus</a>
                    </p>
                </div>
            </div>
        </div>
    </div>




@endsection
