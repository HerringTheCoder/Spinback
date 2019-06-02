@extends('layouts.dashboard')

@section('title', 'Artists')
@section('content')
    @include('metadata.tabs')

    <h3 class="ui dividing header">Add new artist</h3>

    <p>Artist must be added to the local database before he can be used in other parts of the system.</p>

    <form method="get" action="{{ route('artists.search') }}">
        <div class="ui action left icon input">
            <i class="search icon"></i>
            <input type="text" placeholder="Artist" name="query">
            <button type="submit" class="ui button">Search</button>
        </div>
    </form>

    <h3 class="ui dividing header">Artists</h3>

    <div class="resource">
        <div class="controls">
            <button class="ui button disabled delete-resource">
                <i class="trash icon"></i>
                Delete
            </button>
        
            <form method="get" action="{{ route('artists.index') }}" class="ui icon input" style="float: right;">
                <div class="ui icon input">
                    <i class="search icon"></i>
                    <input type="text" name="query" placeholder="Search..." value="{{ request()->input('query') }}">
                </div>
            </form>
        </div>
    
        <table class="ui compact selectable celled striped definition table artists">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artists as $artist)
                    <tr
                        data-id="{{ $artist->id }}"
                        data-delete-route="{{ route('artists.destroy', ['id' => $artist->id]) }}"
                        data-name="{{ $artist->name }}">
                        <td class="collapsing ignored">
                            <div class="ui radio checkbox">
                                <input type="radio" name="artist"><label></label>
                            </div>
                        </td>
                        <td data-label="Name">
                            @if ($artist->country)
                                <i class="{{ strtolower($artist->country) }} flag"></i>
                            @endif
                            <a href="https://musicbrainz.org/artist/{{ $artist->id }}" target="_blank" rel="noopener noreferrer">{{ $artist->name }}</a>
                        </td>
                        <td data-label="Description">{{ $artist->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        {{ $artists->appends(request()->input())->links() }}
    
        @include('commons.modals.delete')
    </div>
@endsection