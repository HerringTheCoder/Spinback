@extends('layouts.dashboard')

@section('title', 'Artists')
@section('content')
    <h3 class="ui dividing header">Add new artist</h3>

    <p>Artist must be added to the local database before he can be used in other parts of the system.</p>

    <form method="get" action="{{ route('artist.search') }}">
        <div class="ui action left icon input">
            <i class="search icon"></i>
            <input type="text" placeholder="Artist" name="query">
            <button type="submit" class="ui button">Search</button>
        </div>
    </form>

    <h3 class="ui dividing header">Artists</h3>

    <button class="ui button disabled delete-artist">
        <i class="trash icon"></i>
        Delete
    </button>

    <table class="ui compact sortable selectable celled striped definition table artists">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artists as $artist)
                <tr
                    data-id="{{ $artist->id }}"
                    data-delete="{{ route('artists.destroy', ['id' => $artist->id]) }}"
                    data-edit="{{ route('artists.edit', ['id' => $artist->id]) }}"
                    data-name="{{ $artist->name }}">
                    <td class="collapsing ignored">
                        <div class="ui radio checkbox">
                            <input type="radio" name="artist" value="{{ $artist->id }}"><label></label>
                        </div>
                    </td>
                    </td>
                    <td data-label="#" data-sort-value="{{ $artist->id }}">{{ $artist->id }}</td>
                    <td data-label="Name">
                        @if ($artist->country)
                            <i class="{{ strtolower($artist->country) }} flag"></i>
                        @endif
                        @if ($artist->brainz_id)
                            <a href="https://musicbrainz.org/artist/{{ $artist->brainz_id }}" target="_blank" rel="noopener noreferrer">{{ $artist->name }}</a>
                        @else
                            {{ $artist->name }}
                        @endif
                    </td>
                    <td data-label="Description">{{ $artist->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $artists->render() }}

    <button class="ui button disabled delete-artist">
        <i class="trash icon"></i>
        Delete
    </button>

    <div class="ui tiny basic modal delete-artist-modal">
        <div class="ui icon header">
            <i class="trash icon"></i>
            Deleting artist
        </div>
        <div class="content">
            You're about to delete <strong></strong>. Are you sure?
        </div>
        <div class="actions">
            <div class="ui basic cancel inverted button">
                Cancel
            </div>
            <div class="ui red ok inverted button">
                <i class="trash icon"></i>
                delete
            </div>
        </div>
    </div>

    <form method="post" class="delete-artist-form">
        @csrf
        @method('delete')
    </form>
    
@endsection

@push('scripts')
    <script>
        $('table.artists').tablesort();

        $('table.artists tbody tr').click(function() {
            $(this).find('td:first-child input[type="radio"]')[0].click();
        });

        $('input[type="radio"]').prop('checked', false);

        $('input[name="artist"]').change(function () {
            const artistId = $('input[name="artist"]:checked').val();
            $('.delete-artist').removeClass('disabled');
            $('table.artists tbody tr').removeClass('active');
            $('tr[data-id="' + artistId + '"]').addClass('active');
        });

        $('button.delete-artist').click(function() {
            const artistId = $('input[name="artist"]:checked').val();
            const artistName = $('tr[data-id="' + artistId + '"]').data('name');
            const deleteRoute = $('tr[data-id="' + artistId + '"]').data('delete');

            $('.delete-artist-modal .content > strong:first-child').text(artistName);
            $('.delete-artist-modal')
                .modal({
                    onApprove: function() {
                        $('form.delete-artist-form')
                            .attr('action', deleteRoute)
                            .submit();
                    }
                })
                .modal('show');
        });
    </script>
@endpush