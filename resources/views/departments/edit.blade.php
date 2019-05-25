@extends('layouts.dashboard')

@section('title', __('departments.edit_title'))
@section('content')
    <h3 class="ui dividing header">{{ __('departments.edit_title') }}</h3>

    <form class="ui form" method="post" action="{{ route('departments.update', ['id' => $department->id]) }}">
        @csrf
        @method('PUT')
        <div class="field">
            <label>@lang('departments.name')</label>
            <input type="text" name="name" placeholder="@lang('departments.name')" value="{{ $department->name }}">
        </div>
        <div class="field">
            <label>@lang('departments.address')</label>
            <input type="text" name="address" placeholder="@lang('departments.address')" value="{{ $department->address }}">
        </div>
        <div class="two fields">
            <div class="field">
                <label>@lang('departments.city')</label>
                <input type="text" name="city" placeholder="@lang('departments.city')" value="{{ $department->city }}">
            </div>
            <div class="field">
                <label>@lang('departments.phone')</label>
                <input type="text" name="phone_number" placeholder="@lang('departments.phone')" value="{{ $department->phone_number }}">
            </div>
        </div>
        <button class="ui button" type="submit">@lang('departments.save')</button>
    </form>
@endsection