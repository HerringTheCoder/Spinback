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
            <div class="six wide column">
                <h3 class="ui header">@lang('home.recently_added')</h3>
                <div class="ui unstackable items">
                    @foreach ($discs as $disc)
                        @include('home.disc_item', ['disc' => $disc, 'price' => $disc->offer_price, 'sold' => false])
                    @endforeach
                </div>
            </div>
            <div class="six wide column">
                <h3 class="ui header">@lang('home.recently_sold')</h3>
                <div class="ui unstackable items">
                    @foreach ($sold as $transaction)
                        @include('home.disc_item', ['disc' => $transaction->disc, 'price' => $transaction->price, 'sold' => true])
                    @endforeach
                </div>
            </div>
            <div class="four wide column">
                <h3 class="ui header">@lang('home.statistics')</h3>
                <div class="ui stacked segment"></div>
            </div>
        </div>
    </div>
@endsection
