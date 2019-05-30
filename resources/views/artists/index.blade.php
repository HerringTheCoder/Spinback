@extends('layouts.dashboard')

@section('title', 'Artists')
@section('content')
    <h3 class="ui dividing header">Add new artist</h3>

    <p>Artist must be added to the local database before he can be used in other parts of the system.</p>

    <form method="post" action="{{ route('artist.search') }}">
        @csrf
        <div class="ui action left icon input">
            <i class="search icon"></i>
            <input type="text" placeholder="Artist" name="artist">
            <button type="submit" class="ui button">Search</button>
        </div>
    </form>

    <h3 class="ui dividing header">Artists</h3>
@endsection