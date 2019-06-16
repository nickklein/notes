@extends('layouts.login')

@section('content')
    <div class="container settings-container">
        <div class="row">
            @include('settings.includes.sidebar')


            <main class="col-7">
                <h1>Account</h1>

                <form action="{{route('settings/account/update')}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <div class="form">
                        <div class="form-group row">
                                <input id="email" type="email" placeholder="E-mail Address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group row">
                                <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
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

                <a href="#" @click="showModal = true">Delete your account</a>
            </main>
        </div>
    </div>
<static-modal 
        v-if="showModal" 
        @close="showModal = false"
        action="{{route('settings/account/destroy')}}"
        title="Delete Account" 
        label="Delete Account" 
        v-bind:input="true"
        v-bind:inputs="[{
            name: 'E-mail Address',
            db: 'email',
            placeholder: 'john.smith@example.org',
            type: 'text',
            value: ''
        }
        ]">
        <p>Deleting your account will delete all your data from our website, including your notes shared with others in the next 30 days. Are you sure you want to delete your account? Please type in your email to confirm</p>
</static-modal>

@endsection