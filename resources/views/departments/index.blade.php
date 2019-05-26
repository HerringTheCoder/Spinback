@extends('layouts.dashboard')

@section('title', __('departments.title'))
@section('content')
    <h3 class="ui dividing header">{{ __('departments.title') }}</h3>

    <button class="ui primary button new-department">
        @lang('departments.new_department')
    </button>
    <button class="ui button disabled edit-department">
        <i class="edit icon"></i>
        @lang('departments.edit')
    </button>
    <button class="ui button disabled delete-department">
        <i class="trash icon"></i>
        @lang('departments.delete')
    </button>

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
                    data-delete="{{ route('departments.destroy', ['id' => $department->id]) }}"
                    data-edit="{{ route('departments.edit', ['id' => $department->id]) }}">
                    <td class="collapsing ignored">
                        <div class="ui radio checkbox">
                            <input type="radio" name="department" value="{{ $department->id }}"><label></label>
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

    <button class="ui primary button new-department">
        @lang('departments.new_department')
    </button>
    <button class="ui button disabled edit-department">
        <i class="edit icon"></i>
        @lang('departments.edit')
    </button>
    <button class="ui button disabled delete-department">
        <i class="trash icon"></i>
        @lang('departments.delete')
    </button>

    <div class="ui tiny modal new-department-modal">
        <i class="close icon"></i>
        <div class="header">
            @lang('departments.new_department')
        </div>
        <div class="content">
            <form class="ui form new-department-form" method="post" action="{{ route('departments.store') }}">
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
                @lang('departments.cancel')
            </div>
            <div class="ui positive button">
                <i class="save icon"></i>
                @lang('departments.save')
            </div>
        </div>
    </div>

    <div class="ui tiny basic modal delete-department-modal">
        <div class="ui icon header">
            <i class="trash icon"></i>
            @lang('departments.delete_header')
        </div>
        <div class="content">
            @lang('departments.delete_confirm')
        </div>
        <div class="actions">
            <div class="ui basic cancel inverted button">
                @lang('departments.cancel')
            </div>
            <div class="ui red ok inverted button">
                <i class="trash icon"></i>
                @lang('departments.delete')
            </div>
        </div>
    </div>

    <form method="post" class="delete-department-form">
        @csrf
        @method('delete')
    </form>
@endsection

@push('scripts')
    <script>
        $('table.departments').tablesort();

        $('button.new-department').click(function() {
            $('.new-department-modal')
                .modal({
                    onApprove: function() {
                        $('.new-department-form').submit();
                    }
                })
                .modal('show');
        });

        $('input[name="department"]').change(function () {
            const departmentId = $('input[name="department"]:checked').val();
            $('.delete-department, .edit-department').removeClass('disabled');
            $('table.departments tbody tr').removeClass('active');
            $('tr[data-id="' + departmentId + '"]').addClass('active');
        });

        $('button.delete-department').click(function() {
            const departmentId = $('input[name="department"]:checked').val();
            const departmentName = $('tr[data-id="' + departmentId + '"] td[data-label="Name"]').text();
            const deleteRoute = $('tr[data-id="' + departmentId + '"]').data('delete');

            $('.delete-department-modal .content > strong:first-child').text(departmentName);
            $('.delete-department-modal')
                .modal({
                    onApprove: function() {
                        $('form.delete-department-form')
                            .attr('action', deleteRoute)
                            .submit();
                    }
                })
                .modal('show');
        });

        $('button.edit-department').click(function() {
            const departmentId = $('input[name="department"]:checked').val();
            document.location = $('tr[data-id="' + departmentId + '"]').data('edit');
        });
    </script>
@endpush