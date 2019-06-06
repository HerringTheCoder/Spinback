@extends('layouts.dashboard')

@section('title', __('albums.page_title'))
@section('content')
    @include('metadata.tabs')

    <h3 class="ui dividing header">@lang('albums.import')</h3>

    <p>@lang('albums.import_desc')</p>

    <form method="get" action="{{ route('albums.import') }}">
        <div class="ui action left icon input">
            <i class="search icon"></i>
            <input type="text" placeholder="Album" name="query">
            <button type="submit" class="ui button">@lang('albums.search')</button>
        </div>
    </form>

    <h3 class="ui dividing header">@lang('albums.page_title')</h3>

    <div class="resource">
        <div class="controls">
            <button class="ui button disabled delete-resource">
                <i class="trash icon"></i>
                @lang('resources.delete_button')
            </button>
        
            <form method="get" action="{{ route('albums.index') }}" style="float: right;">
                <div class="ui icon input">
                    <i class="search icon"></i>
                    <input type="text" name="query" placeholder="Search..." value="{{ request()->input('query') }}">
                </div>
            </form>
        </div>

        <table class="ui compact selectable celled striped definition table albums">
            <thead>
                <tr>
                    <th></th>
                    <th>@lang('albums.cover')</th>
                    <th>@lang('albums.title')</th>
                    <th>@lang('albums.artist')</th>
                    <th>@lang('albums.genre')</th>
                    <th>@lang('albums.release_date')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($albums as $album)
                    <tr
                        data-id="{{ $album->id }}"
                        data-delete-route="{{ route('albums.destroy', ['id' => $album->id]) }}"
                        data-name="{{ $album->title }}">
                        <td class="collapsing ignored">
                            <div class="ui radio checkbox">
                                <input type="radio" name="album"><label></label>
                            </div>
                        </td>
                        <td class="center aligned collapsing">
                            <img src="{{ $album->image() }}" height="80">
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
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $albums->appends(request()->input())->links() }}

        @include('commons.modals.delete')
    </div>
@endsection