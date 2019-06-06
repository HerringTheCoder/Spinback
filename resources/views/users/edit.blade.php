@extends('layouts.dashboard')

@section('title', __('users.edit_title'))
@section('content')
    <h3 class="ui dividing header">@lang('users.edit_title')</h3>

    <form class="ui form" method="post" action="{{ route('users.update', ['id' => $user->id]) }}">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Login</label>
            <input type="text" name="login" placeholder="Login" value="{{ $user->login }}">
        </div>
        <div class="two fields">
            <div class="field">
                <label>@lang('users.first_name')</label>
                <input type="text" name="first_name" placeholder="@lang('users.first_name')" value="{{ $user->first_name }}">
            </div>
            <div class="field">
                <label>@lang('users.last_name')</label>
                <input type="text" name="last_name" placeholder="@lang('users.last_name')" value="{{ $user->last_name }}">
            </div>
        </div>
        <div class="field">
            <label>Email</label>
            <input type="text" name="email" placeholder="Email" value="{{ $user->email }}">
        </div>
        <button class="ui button" type="submit">@lang('resources.save_button')</button>
    </form>
@endsection
