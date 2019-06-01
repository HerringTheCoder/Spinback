@extends('layouts.dashboard')

@section('title', 'Albums')
@section('content')
    @include('metadata.tabs')

    <h3 class="ui dividing header">Add new album</h3>

    <p>Album must be added to the local database before it can be used in other parts of the system.</p>

    <form method="get" action="{{ route('albums.search') }}">
        <div class="ui action left icon input">
            <i class="search icon"></i>
            <input type="text" placeholder="Album" name="query">
            <button type="submit" class="ui button">Search</button>
        </div>
    </form>

    <h3 class="ui dividing header">Albums</h3>

    <table class="ui compact selectable celled striped definition table albums">
        <thead>
            <tr>
                <th></th>
                <th>Cover</th>
                <th>Name</th>
                <th>Artist</th>
                <th>Genre</th>
                <th>Release date</th>
                {{-- <th>Description</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($albums as $album)
                <tr
                    data-id="{{ $album->id }}"
                    data-delete="{{ route('albums.destroy', ['id' => $album->id]) }}"
                    data-title="{{ $album->title }}">
                    <td class="collapsing ignored">
                        <div class="ui radio checkbox">
                            <input type="radio" name="album" value="{{ $album->id }}"><label></label>
                        </div>
                    </td>
                    <td class="center aligned">
                        @if ($album->cover)
                            <img src="{{ asset('storage/covers/' . $album->id . '.jpg') }}" height="80">
                        @else
                            No cover
                        @endif
                    </td>
                    <td data-label="Title">
                        <a href="https://musicbrainz.org/release-group/{{ $album->id }}" target="_blank" rel="noopener noreferrer">{{ $album->title }}</a>
                    </td>
                    <td>
                        @if ($album->artist->country)
                            <i class="{{ strtolower($album->artist->country) }} flag"></i>
                        @endif
                        <a href="https://musicbrainz.org/artist/{{ $album->artist->id }}" target="_blank" rel="noopener noreferrer">{{ $album->artist->name }}</a>
                    </td>
                    <td>
                        {{ $album->genre }}
                    </td>
                    <td>
                        {{ $album->release_date->format('Y-m-d') }}
                    </td>
                    {{-- <td data-label="Description">{{ $artist->description }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection

@push('scripts')
@endpush