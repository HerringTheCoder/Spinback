@extends('layouts.dashboard')

@section('title', __('Monthly report'))
@section('content')
    <h3 class="ui dividing heading">{{ __('Monthly report') }}</h3>

    <p>{{ __('Summary of transactions in this month.') }}</p>

    <table class="ui celled striped stackable sortable table">
        <thead>
            <tr>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Total income') }}</th>
                <th>{{ __('Total outcome') }}</th>
                <th>{{ __('Total profit') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>
                        {{ $result->date }}
                    </td>
                    <td data-sort-value="{{ $result->total_income }}">
                        {{ $result->total_income }} PLN
                    </td>
                    <td data-sort-value="{{ $result->total_outcome }}">
                        {{ $result->total_outcome }} PLN
                    </td>
                    <td data-sort-value="{{ $result->total_income - $result->total_outcome }}">
                        {{ $result->total_income - $result->total_outcome }} PLN
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
    <script>
        $('.ui.table').tablesort();
    </script>
@endpush