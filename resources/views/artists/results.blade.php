@extends('layouts.dashboard')

@section('title', 'Artists results for \'' . request()->input('query') . '\'')
@section('content')
    <h3 class="ui dividing header">Artists results for '<em>{{ request()->input('query') }}</em>'</h3>

    <div class="ui segments">
        @foreach ($artists as $artist)
            <div class="ui segment">
                <div class="ui grid">
                    <div class="twelve wide column">
                        <p>
                            @if (isset($artist->country))
                                <i class="{{ strtolower($artist->country) }} flag"></i>
                            @endif
                            <strong>{{ $artist->name }}</strong>
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
                    <div class="four wide column">
                        <form method="post" action="{{ route('artist.pick') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $artist->id }}">
                            <button type="submit" class="ui right floated primary button">Pick</button>
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