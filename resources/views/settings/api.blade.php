@extends('layouts.login')

@section('content')
    <div class="container settings-container">
        <div class="row">
            @include('settings.includes.sidebar')


            <main class="col-7">
                <h1>API</h1>
                <passport-client></passport-client>
                <passport-authorized-clients></passport-authorized-clients>
                <passport-personal-access-token></passport-personal-access-token>
            </main>
        </div>
    </div>

@endsection