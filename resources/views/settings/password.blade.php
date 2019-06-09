@extends('layouts.login')

@section('content')
    <div class="container settings-container">
        <div class="row">
            @include('settings.includes.sidebar')


            <main class="col-7">
                <h1>Password</h1>

                <form action="{{route('settings/password/update')}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <div class="form">
                        @if (session('password'))
                            {{session('password')}}
                        @endif
                        <div class="form-group row">
                                <input id="password" type="password" placeholder="Current Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row">
                                <input id="new_password" type="password" placeholder="New Password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password" value="{{ old('new_password') }}" required autofocus>

                                @if ($errors->has('new_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row">
                                <input id="new_password_confirmation" type="password" placeholder="Verify Password" class="form-control{{ $errors->has('new_password_confirmation') ? ' is-invalid' : '' }}" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" required autofocus>

                                @if ($errors->has('new_password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save changes') }}
                                </button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
@endsection