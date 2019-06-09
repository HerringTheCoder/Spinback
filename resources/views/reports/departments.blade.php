@extends('layouts.dashboard')

@section('title', __('Departments report'))
@section('content')
    <h3 class="ui dividing heading">{{ __('Departments report') }}</h3>

    <p>{{ __('Here are the top 20 departments, which gained the most income.') }}</p>

    <table class="ui celled striped sortable stackable table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Department') }}</th>
                <th>{{ __('Income') }}</th>
                <th>{{ __('Average price') }}</th>
                <th>{{ __('Count') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $department->name }}
                    </td>
                    <td>
                        <strong>{{ $department->total }} PLN</strong>
                    </td>
                    <td>
                        {{ round($department->avg, 2) }} PLN
                    </td>
                    <td>
                        {{ $department->count }}
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