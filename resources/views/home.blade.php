@extends('layouts.dashboard')

@section('title', __('home.title'))
@section('content')
    <div class="home-background"></div>
    <div class="ui grid">
        <div class="doubling four column row">
            <div class="four wide column">
                <a href="{{ route('departments.index') }}">
                    <div class="ui stacked segment">
                        <h2>{{ $counts['departments'] }}</h2>
                        @lang('home.departments')
                    </div>
                </a>
            </div>
            <div class="four wide column">
                <div class="ui stacked segment">
                    <h2>{{ $counts['transactions'] }}</h2>
                    @lang('home.transactions')
                </div>
            </div>
            <div class="four wide column">
                <div class="ui stacked segment">
                    <h2>{{ $counts['discs'] }}</h2>
                    @lang('home.discs')
                </div>
            </div>
            <div class="four wide column">
                <div class="ui stacked segment">
                    <h2>{{ $counts['parcels'] }}</h2>
                    @lang('home.parcels')
                </div>
            </div>
        </div>
    </div>
    <div class="ui divided grid">
        <div class="stackable row">
            <div class="ten wide column">
                <h3 class="ui header">Lately added discs</h3>
                <div class="ui unstackable items">
                    @foreach ($discs as $disc)
                        <a class="item" href="{{ route('discs.show', ['id' => $disc->id]) }}">
                            <div class="ui tiny image">
                                @if ($disc->album->cover)
                                    <img src="{{ $disc->album->image() }}">
                                @endif
                            </div>
                            <div class="middle aligned content">
                                <div class="ui small header">{{ $disc->album->title }}</div>
                                <div class="meta">
                                    in {{ $disc->department->name }} for {{ $disc->offer_price }} PLN
                                </div>
                                <div class="extra">
                                    {{ $disc->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="six wide column">
                <h3 class="ui header">Statistics</h3>
                <div class="ui stacked segment"></div>
            </div>
        </div>
    </div>
@endsection
