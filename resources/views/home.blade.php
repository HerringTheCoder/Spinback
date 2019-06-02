@extends('layouts.dashboard')

@section('title', __('home.title'))
@section('content')
    <div class="home-background"></div>
    <div class="ui grid">
        <div class="doubling four column row">
            <div class="four wide column">
                <a href="{{ route('departments.index') }}">
                    <div class="ui stacked segment">
                        <h2>{{ $departments }}</h2>
                        @lang('home.departments')
                    </div>
                </a>
            </div>
            <div class="four wide column">
                <div class="ui stacked segment">
                    <h2>{{ $transactions }}</h2>
                    @lang('home.transactions')
                </div>
            </div>
            <div class="four wide column">
                <div class="ui stacked segment">
                    <h2>{{ $discs }}</h2>
                    @lang('home.discs')
                </div>
            </div>
            <div class="four wide column">
                <div class="ui stacked segment">
                    <h2>{{ $parcels }}</h2>
                    @lang('home.parcels')
                </div>
            </div>
        </div>
    </div>
@endsection
