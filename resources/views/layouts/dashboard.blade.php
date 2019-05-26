@extends('layouts.master')

@section('body')
<div class="dashboard">
    @include('commons.navigation')

    @include('commons.header')

    <main class="main">
        @include('commons.messages')
        
        @yield('content')
    </main>
</div>
@endsection