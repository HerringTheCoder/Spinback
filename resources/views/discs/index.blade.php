@extends('layouts.dashboard')

@section('title', __('discs.page_title'))
@section('content')
    <h3 class="ui dividing header">@lang('discs.page_title')</h3>

    <form method="get" action="{{ route('discs.index') }}">
        @if ($album)
            <input type="hidden" name="album" value="{{ $album->id }}">
        @else
            <input type="hidden" name="album">
        @endif
        <div class="ui form">
            <div class="three fields">
                <div class="field">
                    <div class="ui search album-search">
                        @if ($album)
                            <input class="prompt" type="text" placeholder="@lang('discs.album_title')" value="{{ $album->title }}">
                        @else
                            <input class="prompt" type="text" placeholder="@lang('discs.album_title')">
                        @endif
                        <div class="results"></div>
                    </div>
                </div>
                <div class="field">
                    <select class="ui search dropdown department-dropdown" name="department">
                        <option value="">@lang('discs.department')</option>
                        @foreach ($departments as $department)
                            @if ($department->id == request()->input('department'))
                                <option selected value="{{ $department->id }}">{{ $department->name }}</option>
                            @else
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <button class="ui button" type="submit">@lang('discs.filter')</button>
                </div>
            </div> 
        </div>
    </form>

    <div class="resource">
        <div class="controls">
            <button class="ui primary button new-resource">
                @lang('discs.new_disc')
            </button>
            <button class="ui button disabled edit-resource">
                <i class="edit icon"></i>
                {{ __('resources.edit_button') }}
            </button>
            <button class="ui button disabled delete-resource">
                <i class="trash icon"></i>
                {{ __('resources.delete_button') }}
            </button>
        </div>

        <table class="ui compact selectable celled striped definition table departments">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>@lang('discs.department')</th>
                    <th>@lang('discs.cover')</th>
                    <th>Album</th>
                    {{-- <th>Artist</th> --}}
                    <th>@lang('discs.condition')</th>
                    <th>@lang('discs.offer_price')</th>
                    <th>@lang('discs.created_at')</th>
                    <th>@lang('discs.updated_at')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discs as $disc)
                    <tr
                        data-id="{{ $disc->id }}"
                        data-delete-route="{{ route('discs.destroy', ['id' => $disc->id]) }}"
                        data-edit-route="{{ route('discs.edit', ['id' => $disc->id]) }}"
                        data-name="{{ $disc->album->title }} (#{{ $disc->id }})">
                        <td class="collapsing ignored">
                            <div class="ui radio checkbox">
                                <input type="radio" name="disc"><label></label>
                            </div>
                        </td>
                        <td class="collapsing">
                            <a href="{{ route('discs.show', ['id' => $disc->id]) }}">
                                {{ $disc->id }}
                            </a>
                        </td>
                        <td class="collapsing">{{ $disc->department->name }}</td>
                        <td class="collapsing">
                            <img src="{{ $disc->album->image() }}" height="80">
                        </td>
                        <td>
                            <a href="https://musicbrainz.org/release-group/{{ $disc->album->id }}" target="_blank" rel="noopener noreferrer">{{ $disc->album->title }}</a>
                        </td>
                        {{-- <td>
                            @if ($disc->album->artist->country)
                                <i class="{{ strtolower($disc->album->artist->country) }} flag"></i>
                            @endif
                            <a href="https://musicbrainz.org/artist/{{ $disc->album->artist->id }}" target="_blank" rel="noopener noreferrer">{{ $disc->album->artist->name }}</a>
                        </td> --}}
                        <td>
                            {{ $disc->condition }}
                        </td>
                        <td class="collapsing right aligned">
                            {{ $disc->offer_price }} PLN
                        </td>
                        <td class="collapsing">
                            {{ $disc->created_at }}
                        </td>
                        <td class="collapsing">
                            {{ $disc->updated_at }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $discs->appends(request()->input())->links() }}

        <div class="controls">
            <button class="ui primary button new-resource">
                @lang('discs.new_disc')
            </button>
            <button class="ui button disabled edit-resource">
                <i class="edit icon"></i>
                {{ __('resources.edit_button') }}
            </button>
            <button class="ui button disabled delete-resource">
                <i class="trash icon"></i>
                {{ __('resources.delete_button') }}
            </button>
        </div>

        @include('discs.new_modal')
        @include('commons.modals.delete')
@endsection

@push('scripts')
    <script>
        $('.department-dropdown').dropdown({clearable: true});
        $('.album-search').search({
            apiSettings: {
                url: '/search/albums?query={query}'
            },
            fields: {
                description: 'artist'
            },
            selectFirstResult: true,
            onSelect: function (result) {
                $(this).closest('form').find('input[name="album"]').val(result.id);
            }
        });
        $('.album-search input').keyup(function() {
            if (!this.value) {
                $(this).closest('form').find('input[name="album"]').val('');
            }
        });
    </script>
@endpush
