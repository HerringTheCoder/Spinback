@extends('layouts.dashboard')

@section('title', __('discs.edit_title'))
@section('content')
    <h3 class="ui dividing header">@lang('discs.edit_title')</h3>

    <form class="ui form" method="post" action="{{ route('discs.update', ['id' => $disc->id]) }}">
        @csrf
        @method('PUT')
        <div class="two fields">
            <div class="field">
                <label>@lang('discs.album_id')</label>
                <input type="text" placeholder="Album" value="{{ $disc->album_id }}" disabled>
            </div>
            <div class="field">
                <label>@lang('discs.department_id')</label>
                <input type="text" placeholder="@lang('discs.department')" value="{{ $disc->department_id }}" disabled>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label>@lang('discs.condition')</label>
                <input type="text" name="condition" placeholder="@lang('discs.condition')" value="{{ $disc->condition }}">
            </div>
            <div class="field">
                <label>@lang('discs.offer_price')</label>
                <div class="ui right labeled input">
                    <input type="text" name="offer_price" placeholder="@lang('discs.offer_price')" value="{{ $disc->offer_price }}">
                    <div class="ui label">PLN</div>
                </div>
            </div>
        </div>
        
        {{-- <div class="two fields">
            <div class="field">
                <label>@lang('departments.city')</label>
                <input type="text" name="city" placeholder="@lang('departments.city')" value="{{ $department->city }}">
            </div>
            <div class="field">
                <label>@lang('departments.phone')</label>
                <input type="text" name="phone_number" placeholder="@lang('departments.phone')" value="{{ $department->phone_number }}">
            </div>
        </div> --}}
        <button class="ui button" type="submit">@lang('resources.save_button')</button>
    </form>
@endsection