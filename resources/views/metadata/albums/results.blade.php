@extends('layouts.dashboard')

@section('title', 'Albums results for \'' . request()->input('query') . '\'')
@section('content')
    <h3 class="ui dividing header">Albums results for '<em>{{ request()->input('query') }}</em>'</h3>

    <div class="ui segments">
        @foreach ($albums as $album)
            <div class="ui segment">
                <div class="ui middle aligned grid">
                    <div class="twelve wide column">
                        <p>
                                <a href="https://musicbrainz.org/release-group/{{ $album->id }}" target="_blank" rel="noopener noreferrer"><strong>{{ $album->title }}</strong></a>
                                by {{ $album->{'artist-credit'}[0]->artist->name }} 
                        </p>
                        @if (isset($album->tags))
                            <p class="ui labels">
                                @foreach ($album->tags as $tag)
                                    <span class="ui label">{{ $tag->name }}</span>
                                @endforeach
                            </p>
                        @endif
                    </div>
                    <div class="four wide right aligned column">
                        <form method="post" action="{{ route('albums.store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $album->id }}">
                            <button type="submit" class="ui primary button">Pick</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <p>
        Search results provided by <a href="https://musicbrainz.org/" alt="MusicBrainz"><img class="ui tiny spaced image" src="{{ asset('images/musicbrainz.svg') }}"></a>
    </p>
    
@endsection