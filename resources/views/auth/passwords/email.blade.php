@extends('layouts.master')

@section('title', __('auth.reset_title'))
@section('body')
<div class="ui grid middle aligned center aligned auth">
    <div class="column">
        <img src="{{ asset('images/spinback-300.png') }}" title="Spinback" class="logo">
        <form class="ui large form" method="post" action="{{ route('password.email') }}">
            @csrf

            @if (session('status'))
                <div class="ui positive message">
                    {{ session('status') }}
                </div>
            @endif

            <div class="ui piled segment">
                <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                    <div class="ui left icon input">
                        <i class="envelope icon"></i>
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                    </div>
                    @if ($errors->has('email'))
                        <div class="ui pointing red basic label">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <button class="ui fluid large orange submit button" type="submit">@lang('auth.labels.send_reset')</button>
            </div>
        </form>

        <div class="ui basic segment">
            <p><a href="{{ route('login') }}">@lang('auth.back_to_login')</a></p>
        </div>
    </div>
</div>
@endsection
