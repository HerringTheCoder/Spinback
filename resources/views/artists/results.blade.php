@extends('layouts.dashboard')

@section('title', 'Artists search results')
@section('content')
    <h3 class="ui dividing header">Artists search results</h3>

    <div class="ui segments">
        @foreach ($artists as $artist)
            <div class="ui segment">
                <div class="ui grid">
                    <div class="twelve wide column">
                        <p>
                            <strong>{{ $artist->name }}</strong>
                            {!! isset($artist->disambiguation) ? "<em>({$artist->disambiguation})</em>" : "" !!}
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
                        <button class="ui right floated primary button">Pick</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <p>
        Search results provided by <a href="https://musicbrainz.org/" alt="MusicBrainz"><img class="ui tiny spaced image" src="{{ asset('images/musicbrainz.svg') }}"></a>
    </p>
    
@endsection