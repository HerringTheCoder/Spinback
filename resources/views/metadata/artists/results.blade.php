@extends('layouts.dashboard')

@section('title', 'Artists results for \'' . request()->input('query') . '\'')
@section('content')
    <h3 class="ui dividing header">Artists results for '<em>{{ request()->input('query') }}</em>'</h3>
    
    @if (!empty($artists))
        <div class="ui segments">
            @foreach ($artists as $artist)
                <div class="ui segment">
                    <div class="ui middle aligned grid">
                        <div class="twelve wide column">
                            <p>
                                @if (isset($artist->country))
                                    <i class="{{ strtolower($artist->country) }} flag"></i>
                                @endif
                                <a href="https://musicbrainz.org/artist/{{ $artist->id }}" target="_blank" rel="noopener noreferrer"><strong>{{ $artist->name }}</strong></a>
                                @if (isset($artist->disambiguation))
                                    <em>({{ $artist->disambiguation }})</em>
                                @endif
                            </p>
                            @if (isset($artist->tags))
                                <p class="ui labels">
                                    @foreach ($artist->tags as $tag)
                                        <span class="ui label">{{ $tag->name }}</span>
                                    @endforeach
                                </p>
                            @endif
                        </div>
                        <div class="four wide right aligned column">
                            <form method="post" action="{{ route('artists.store') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $artist->id }}">
                                <button type="submit" class="ui primary button">Pick</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No results found.</p>
    @endif

    <p>
        Search results provided by <a href="https://musicbrainz.org/" alt="MusicBrainz"><img class="ui tiny spaced image" src="{{ asset('images/musicbrainz.svg') }}"></a>
    </p>
    
@endsection