@extends('layouts.master')

@section('title', 'Reset password')
@section('body')
<div class="ui grid middle aligned center aligned auth">
    <div class="column">
        <img src="{{ asset('images/spinback-300.png') }}" title="Spinback" class="logo">
        <form class="ui large form" method="post" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="ui piled segment">
                <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                    <div class="ui left icon input">
                        <i class="envelope icon"></i>
                        <input type="text" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                        <div class="ui pointing red basic label">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                    <div class="ui left icon input">
                        <i class="key icon"></i>
                        <input type="password" name="password" placeholder="@lang('auth.labels.password')" required>
                    </div>
                    @if ($errors->has('password'))
                        <div class="ui pointing red basic label">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="key icon"></i>
                        <input type="password" name="password_confirmation" placeholder="@lang('auth.labels.repeat_password')" required>
                    </div>
                </div>

                <button class="ui fluid large orange submit button" type="submit">@lang('auth.labels.reset')</button>
            </div>
        </form>

    </div>
</div>
@endsection
