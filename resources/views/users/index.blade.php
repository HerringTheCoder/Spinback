@extends('layouts.dashboard')

@section('title', __('users.title'))
@section('content')
    <h3 class="ui dividing header">{{ __('users.title') }}</h3>

    <div class="resource">
        <div class="controls">
            <button class="ui primary button new-resource">
                @lang('users.new_user')
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

        <table class="ui compact sortable selectable celled striped definition table users">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>Login</th>
                    <th>@lang('users.first_name')</th>
                    <th>@lang('users.last_name')</th>
                    <th>Email</th>
                    <th>@lang('users.created_at')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr
                        data-id="{{ $user->id }}"
                        data-delete-route="{{ route('users.destroy', ['id' => $user->id]) }}"
                        data-edit-route="{{ route('users.edit', ['id' => $user->id]) }}"
                        data-name="{{ $user->fullName }}">
                        <td class="collapsing ignored">
                            <div class="ui radio checkbox">
                                <input type="radio" name="users" id="radio"><label></label>
                            </div>
                        </td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="controls">
            <button class="ui primary button new-resource">
                @lang('users.new_user')
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
    
        @include('users.new_modal')
        @include('commons.modals.delete')
    </div>
@endsection

@push('scripts')
    <script>
    </script>
@endpush
