@extends('layouts.dashboard')

@section('title', 'Discs')
@section('content')
    <h3 class="ui dividing header">Discs</h3>

    <div class="resource">
        <div class="controls">
            <button class="ui primary button new-resource">
                New disc
            </button>
            <button class="ui button disabled edit-resource">
                <i class="edit icon"></i>
                {{ __('resources.edit_button') }}
            </button>
            <button class="ui button disabled delete-resource">
                <i class="trash icon"></i>
                {{ __('resources.delete_button') }}
            </button>

            {{-- <select class="ui compact selection dropdown">
                <option value="all">All</option>
                <option selected="" value="articles">Articles</option>
                <option value="products">Products</option>
            </select> --}}
        </div>

        <table class="ui compact selectable celled striped definition table departments">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>Department</th>
                    <th>Cover</th>
                    <th>Album</th>
                    <th>Artist</th>
                    <th>Condition</th>
                    <th>Price</th>
                    <th>Created</th>
                    <th>Updated</th>
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
                            {{ $disc->id }}
                        </td>
                        <td class="collapsing">{{ $disc->department->name }}</td>
                        <td class="collapsing">
                            @if ($disc->album->cover)
                                <img src="{{ asset('storage/covers/' . $disc->album->id . '.jpg') }}" height="80">
                            @else
                                No cover
                            @endif
                        </td>
                        <td>
                            <a href="https://musicbrainz.org/release-group/{{ $disc->album->id }}" target="_blank" rel="noopener noreferrer">{{ $disc->album->title }}</a>
                        </td>
                        <td>
                            @if ($disc->album->artist->country)
                                <i class="{{ strtolower($disc->album->artist->country) }} flag"></i>
                            @endif
                            <a href="https://musicbrainz.org/artist/{{ $disc->album->artist->id }}" target="_blank" rel="noopener noreferrer">{{ $disc->album->artist->name }}</a>
                        </td>
                        <td>
                            {{ $disc->condition }}
                        </td>
                        <td class="collapsing">
                            {{ $disc->offer_price }}
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

        <div class="controls">
            <button class="ui primary button new-resource">
                New disc
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

        <div class="ui tiny modal new-resource-modal">
            <i class="close icon"></i>
            <div class="header">
                New disc
            </div>
            <div class="content">
                <form class="ui form" method="post" action="{{ route('discs.store') }}">
                    @csrf
                    <div class="field">
                        <label>@lang('departments.name')</label>
                        <input type="text" name="name" placeholder="@lang('departments.name')">
                    </div>
                    <div class="field">
                        <label>@lang('departments.address')</label>
                        <input type="text" name="address" placeholder="@lang('departments.address')">
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>@lang('departments.city')</label>
                            <input type="text" name="city" placeholder="@lang('departments.city')">
                        </div>
                        <div class="field">
                            <label>@lang('departments.phone')</label>
                            <input type="text" name="phone_number" placeholder="@lang('departments.phone')">
                        </div>
                    </div>
                </form>
            </div>
            <div class="actions">
                <div class="ui deny button">
                    {{ __('resources.cancel_button') }}
                </div>
                <div class="ui positive button">
                    <i class="save icon"></i>
                    {{ __('resources.save_button') }}
                </div>
            </div>
        </div>

        @include('commons.modals.delete')
@endsection

@push('scripts')
    <script>
        $('table.departments').tablesort();
    </script>
@endpush