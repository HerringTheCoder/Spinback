@extends('layouts.dashboard')

@section('title', __('departments.title'))
@section('content')
    <h3 class="ui dividing header">{{ __('departments.title') }}</h3>

    <div class="resource">
        <div class="controls">
            <button class="ui primary button new-resource">
                @lang('departments.new_department')
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

        <table class="ui compact sortable selectable celled striped definition table departments">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>@lang('departments.name')</th>
                    <th>@lang('departments.city')</th>
                    <th>@lang('departments.address')</th>
                    <th>@lang('departments.phone')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr
                        data-id="{{ $department->id }}"
                        data-delete-route="{{ route('departments.destroy', ['id' => $department->id]) }}"
                        data-edit-route="{{ route('departments.edit', ['id' => $department->id]) }}"
                        data-name="{{ $department->name }}">
                        <td class="collapsing ignored">
                            <div class="ui radio checkbox">
                                <input type="radio" name="departments"><label></label>
                            </div>
                        </td>
                        </td>
                        <td data-label="#" data-sort-value="{{ $department->id }}">{{ $department->id }}</td>
                        <td data-label="Name">{{ $department->name }}</td>
                        <td data-label="City">{{ $department->city }}</td>
                        <td data-label="Address">{{ $department->address }}</td>
                        <td data-label="Phone">{{ $department->phone_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="controls">
            <button class="ui primary button new-resource">
                @lang('departments.new_department')
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
                @lang('departments.new_department')
            </div>
            <div class="content">
                <form class="ui form" method="post" action="{{ route('departments.store') }}">
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