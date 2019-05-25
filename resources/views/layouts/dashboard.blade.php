@extends('layouts.master')

@section('body')
<div class="dashboard">
    @include('commons.navigation')

    @include('commons.header')

    <main class="main">
        @yield('content')
    </main>
</div>
@endsection