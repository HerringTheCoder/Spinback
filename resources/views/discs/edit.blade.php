@extends('layouts.dashboard')

@section('title', 'Edit disc')
@section('content')
    <h3 class="ui dividing header">Edit disc</h3>

    <form class="ui form" method="post" action="{{ route('discs.update', ['id' => $disc->id]) }}">
        @csrf
        @method('PUT')
        <div class="two fields">
            <div class="field">
                <label>Album ID</label>
                <input type="text" placeholder="Album" value="{{ $disc->album_id }}" disabled>
            </div>
            <div class="field">
                <label>Department ID</label>
                <input type="text" placeholder="Department" value="{{ $disc->department_id }}" disabled>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label>Condition</label>
                <input type="text" name="condition" placeholder="Condition" value="{{ $disc->condition }}">
            </div>
            <div class="field">
                <label>Offer price</label>
                <div class="ui right labeled input">
                    <input type="text" name="offer_price" placeholder="Offer price" value="{{ $disc->offer_price }}">
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
        <button class="ui button" type="submit">Save</button>
    </form>
@endsection