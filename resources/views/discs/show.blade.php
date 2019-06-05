@extends('layouts.dashboard')

@section('title', $disc->album->title . ' disc')
@section('content')
    <h3 class="ui dividing header">Disc</h3>

    <table class="ui definition table">
        <tbody>
            <tr>
                <td>Cover</td>
                <td>
                    <img class="ui image" src="{{ $disc->album->image() }}">
                </td>
            </tr>
            <tr>
                <td>Title</td>
                <td>
                    <a href="https://musicbrainz.org/release-group/{{ $disc->album->id }}" target="_blank" rel="noopener noreferrer">{{ $disc->album->title }}</a>
                </td>
            </tr>
            <tr>
                <td>Artist</td>
                <td>
                    <a href="https://musicbrainz.org/artist/{{ $disc->album->artist->id }}" target="_blank" rel="noopener noreferrer">{{ $disc->album->artist->name }}</a>
                </td>
            </tr>
            <tr>
                <td>#</td>
                <td>
                    {{ $disc->id }}
                </td>
            </tr>
            <tr>
                <td>Department</td>
                <td>
                    {{ $disc->department->name }}
                </td>
            </tr>
            <tr>
                <td>Condition</td>
                <td>
                    {{ $disc->condition }}
                </td>
            </tr>
            <tr>
                <td>Offer price</td>
                <td>
                    {{ $disc->offer_price }} PLN
                </td>
            </tr>
            <tr>
                <td>Sold</td>
                <td>
                    @if($disc->sold)
                        <i class="green check icon"></i> Yes
                    @else
                        No
                    @endif
                </td>
            </tr>
            <tr>
                <td>Added</td>
                <td>
                    {{ $disc->created_at }}
                </td>
            </tr>
            <tr>
                <td>Updated</td>
                <td>
                    {{ $disc->updated_at }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="controls">
        @unless($disc->sold)
            <button class="ui button">
                <i class="plus icon"></i>
                Make a transaction
            </button>
        @endunless
        <a class="ui button" href="{{ route('discs.edit', ['id' => $disc->id]) }}">
            <i class="pencil icon"></i>
            Edit
        </a>
        <button class="ui delete button">
            <i class="trash icon"></i>
            Delete
        </button>
    </div>
        
    @include('commons.modals.delete')
@endsection

@push('scripts')
    <script>
        $('.delete.button').click(function () {
            const name = '{{ $disc->album->title }} (#{{ $disc->id }})';
            const deleteRoute = '{{ route('discs.destroy', ['id' => $disc->id]) }}';
            const $modal = $('.delete-modal');

            $modal.find('.content > strong').text(name);
            $modal
                .modal({
                    onApprove: function() {
                        $('.delete-modal form')
                            .attr('action', deleteRoute)
                            .submit();
                    }
                })
                .modal('show');
        });
    </script>
@endpush