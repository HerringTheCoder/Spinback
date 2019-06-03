@extends('layouts.dashboard')

@section('title', __('parcels.edit_title'))
@section('content')
    <h3 class="ui dividing header">{{ __('parcels.edit_title') }}</h3>

    <form class="ui form" method="post" action="{{ route('parcels.update', ['id' => $parcel->id]) }}">
        @csrf
        @method('PATCH')
        <div class="field">
            <label>@lang('parcels.tracking_code')</label>
            <input type="text" name="tracking_code" placeholder="@lang('parcels.tracking_code')" value="{{ $parcel->tracking_code }}">
        </div>
            <div class="field ui checkbox">
                    <input type="hidden" name="completed" value="0" />
                <input type="checkbox" name="completed" value="1" @if($parcel->completed) checked @endif>
                <label>@lang('parcels.confirm')</label>
              </div>
        <button class="ui orange button" type="submit">@lang('parcels.save')</div>
    </form>
@endsection
