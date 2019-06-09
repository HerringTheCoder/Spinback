@extends('layouts.dashboard')

@section('title', __('Albums report'))
@section('content')
    <h3 class="ui dividing heading">{{ __('Albums report') }}</h3>

    <p>{{ __('Here are the top 20 albums, which gained the most income.') }}</p>

    <table class="ui celled striped stackable sortable table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Cover') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Income') }}</th>
                <th>{{ __('Average price') }}</th>
                <th>{{ __('Count') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td class="collapsing">
                        <img src="{{ $album->image() }}" height="80">
                    </td>
                    <td>
                        {{ $album->title }}
                    </td>
                    <td data-sort-value="{{ $album->total }}">
                        <strong>{{ $album->total }} PLN</strong>
                    </td>
                    <td data-sort-value="{{ round($album->avg) }}">
                        {{ round($album->avg, 2) }} PLN
                    </td>
                    <td data-sort-value="{{ $album->count }}">
                        {{ $album->count }}
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