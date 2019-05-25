@extends('layouts.master')

@section('body')
<div class="ui grid middle aligned center aligned auth">
    <div class="column">
        <img src="{{ asset('images/spinback-300.png') }}" title="Spinback" class="logo">
        <form class="ui large form" method="post" action="{{ route('login') }}">
            @csrf

            <div class="ui piled segment">
                <div class="field{{ $errors->has('login') ? ' error' : '' }}">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="login" placeholder="{{ __('auth.labels.login') }}" value="{{ old('login') }}">
                    </div>
                    @if ($errors->has('login'))
                        <div class="ui pointing red basic label">
                            {{ $errors->first('login') }}
                        </div>
                    @endif
                </div>

                <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                    <div class="ui left icon input">
                        <i class="key icon"></i>
                        <input type="password" name="password" placeholder="{{ __('auth.labels.password') }}">
                    </div>
                    @if ($errors->has('password'))
                        <div class="ui pointing red basic label">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <button class="ui fluid large orange submit button" type="submit">{{  __('auth.labels.submit') }}</button>
            </div>

        </form>
        
        <div class="container">
            <a href="{{ route('locale', ['locale' => 'pl']) }}">
                <button class="ui button">
                    <i class="pl flag"></i> Polski
                </button>
            </a>
            
            <a href="{{ route('locale', ['locale' => 'en']) }}">
                    <button class="ui button">
                    <i class="uk flag"></i> English
                </button>
            </a>
        </div>
    </div>
</div>
@endsection
