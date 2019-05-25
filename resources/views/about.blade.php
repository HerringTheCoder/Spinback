@extends('layouts.dashboard')

@section('content')
    <h3 class="ui dividing header">{{ __('dashboard.nav.about') }}</h3>
    <p>@lang('about.about')</p>
    <p></p>
    <img class="ui centered small bordered image" src="{{ asset('images/spinback-300.png') }}">
    <p></p>
    <p></p>
    <p>@lang('about.open_source') <i class="github icon"></i><a href="https://github.com/HerringTheCoder/Spinback">Github</a>.</p></p>
@endsection
