@extends('layouts.dashboard')

@section('title', __('artists.title'))
@section('content')
    @include('metadata.tabs')

    <h3 class="ui dividing header">@lang('artists.import')</h3>

    <p>@lang('artists.import_desc')</p>

    <form method="get" action="{{ route('artists.import') }}">
        <div class="ui action left icon input">
            <i class="search icon"></i>
            <input type="text" placeholder="Artist" name="query">
            <button type="submit" class="ui button">@lang('artists.search')</button>
        </div>
    </form>

    <h3 class="ui dividing header">@lang('artists.title')</h3>

    <div class="resource">
        <div class="controls">
            <button class="ui button disabled delete-resource">
                <i class="trash icon"></i>
                @lang('resources.delete_button')
            </button>
        
            <form method="get" action="{{ route('artists.index') }}" class="ui icon input" style="float: right;">
                <div class="ui icon input">
                    <i class="search icon"></i>
                    <input type="text" name="query" placeholder="@lang('artists.search')..." value="{{ request()->input('query') }}">
                </div>
            </form>
        </div>
    
        <table class="ui compact selectable celled striped definition table artists">
            <thead>
                <tr>
                    <th></th>
                    <th>@lang('artists.name')</th>
                    <th>@lang('artists.description')</th>
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