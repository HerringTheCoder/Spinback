@extends('layouts.dashboard')

@section('title', $disc->album->title . ' disc')
@section('content')
    <h3 class="ui dividing header">Disc</h3>

    <table class="ui definition table">
        <tbody>
            <tr>
                <td>@lang('discs.cover')</td>
                <td>
                    <img class="ui image" src="{{ $disc->album->image() }}">
                </td>
            </tr>
            <tr>
                <td>@lang('discs.title')</td>
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
                <td>@lang('discs.department')</td>
                <td>
                    {{ $disc->department->name }}
                </td>
            </tr>
            <tr>
                <td>@lang('discs.condition')</td>
                <td>
                    {{ $disc->condition }}
                </td>
            </tr>
            <tr>
                <td>@lang('discs.offer_price')</td>
                <td>
                    {{ $disc->offer_price }} PLN
                </td>
            </tr>
            <tr>
                <td>@lang('discs.sold')</td>
                <td>
                    @if($disc->sold)
                        <i class="green check icon"></i> @lang('discs.yes')
                    @else
                        @lang('discs.no')
                    @endif
                </td>
            </tr>
            <tr>
                <td>@lang('discs.created_at')</td>
                <td>
                    {{ $disc->created_at }}
                </td>
            </tr>
            <tr>
                <td>@lang('discs.updated_at')</td>
                <td>
                    {{ $disc->updated_at }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="controls">
        @unless($disc->sold)
            <a href="{{ route('transactions.index', ['department_id' => $disc->department_id, 'disc_id' => $disc->id, 'price' => $disc->offer_price]) }}">
                <button class="ui button">
                    <i class="plus icon"></i>
                    @lang('discs.make_transaction')
                </button>
            </a>
        @endunless
        <a class="ui button" href="{{ route('discs.edit', ['id' => $disc->id]) }}">
            <i class="pencil icon"></i>
            @lang('resources.edit_button')
        </a>
        <button class="ui delete button">
            <i class="trash icon"></i>
            @lang('resources.delete_button')
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