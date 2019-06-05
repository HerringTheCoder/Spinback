@extends('layouts.dashboard')

@section('title', __('parcels.title'))
@section('content')
    <h3 class="ui dividing header">{{ __('parcels.title') }}</h3>

    <div class="resource">
        <div class="controls">
            <button class="ui primary button new-parcel">
                @lang('parcels.new_parcel')
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

        <table class="ui compact sortable selectable celled striped definition table parcels">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>@lang('parcels.tracking_code')</th>
                    <th>@lang('parcels.completed')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parcels as $parcel)
                    <tr
                        data-id="{{ $parcel->id }}"
                        data-delete-route="{{ route('parcels.destroy', ['id' => $parcel->id]) }}"
                        data-edit-route="{{ route('parcels.edit', ['id' => $parcel->id]) }}"
                        data-name="{{ $parcel->tracking_code }}">
                        <td class="collapsing ignored">
                            <div class="ui radio checkbox">
                                <input type="radio" name="parcels" id="radio"><label></label>
                            </div>
                        </td>
                        </td>
                        <td data-label="#" data-sort-value="{{ $parcel->id }}">{{ $parcel->id }}</td>
                        <td data-label="Tracking_code">{{ $parcel->tracking_code }}</td>
                        <td data-label="Completed">@if($parcel->completed) <i class="check icon"></i>@else @lang('parcels.awaiting')@endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="controls">
            <button class="ui primary button new-parcel">
                @lang('parcels.new_parcel')
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

        <div class="ui tiny modal new-parcel-modal">
            <i class="close icon"></i>
            <div class="header">
                @lang('parcels.new_parcel')
            </div>
            <div class="content">
                <form class="ui form new-parcel-form" method="post" action="{{ route('parcels.store') }}">
                    @csrf
                    <div class="field">
                        <label>@lang('parcels.tracking_code')</label>
                        <input type="text" name="tracking_code" placeholder="@lang('parcels.tracking_code')">
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
        $('table.parcels').tablesort();

        $('button.new-parcel').click(function() {
            $('.new-parcel-modal')
                .modal({
                    onApprove: function() {
                        $('.new-parcel-form').submit();
                    }
                })
                .modal('show');
        });
    </script>
@endpush
