@extends('layouts.dashboard')

@section('title', __('departments.title'))
@section('content')
    <h3 class="ui dividing header">{{ __('departments.title') }}</h3>

    <button class="ui primary button new-department">
        New department
    </button>
    <button class="ui button disabled edit-department">
        <i class="edit icon"></i>
        Edit
    </button>
    <button class="ui button disabled delete-department">
        <i class="trash icon"></i>
        Delete
    </button>

    <table class="ui compact celled striped definition table departments">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Name</th>
                <th>City</th>
                <th>Address</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr
                    data-id="{{ $department->id }}"
                    data-delete="{{ route('departments.destroy', ['id' => $department->id]) }}"
                    data-edit="{{ route('departments.edit', ['id' => $department->id]) }}">
                    <td class="collapsing">
                        <div class="ui radio checkbox">
                            <input type="radio" name="department" value="{{ $department->id }}"><label></label>
                        </div>
                    </td>
                    </td>
                    <td data-label="#">{{ $department->id }}</td>
                    <td data-label="Name">{{ $department->name }}</td>
                    <td data-label="City">{{ $department->city }}</td>
                    <td data-label="Address">{{ $department->address }}</td>
                    <td data-label="Phone">{{ $department->phone_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button class="ui primary button new-department">
        New department
    </button>
    <button class="ui button disabled edit-department">
        <i class="edit icon"></i>
        Edit
    </button>
    <button class="ui button disabled delete-department">
        <i class="trash icon"></i>
        Delete
    </button>

    <div class="ui tiny modal new-department-modal">
        <i class="close icon"></i>
        <div class="header">
            New department
        </div>
        <div class="content">
            <form class="ui form new-department-form" method="post" action="{{ route('departments.store') }}">
                @csrf
                <div class="field">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Department name">
                </div>
                <div class="field">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="Address">
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>City</label>
                        <input type="text" name="city" placeholder="City">
                    </div>
                    <div class="field">
                        <label>Phone</label>
                        <input type="text" name="phone_number" placeholder="Phone number">
                    </div>
                </div>
            </form>
        </div>
        <div class="actions">
            <div class="ui deny button">
                Cancel
            </div>
            <div class="ui positive button">
                <i class="save icon"></i>
                Save
            </div>
        </div>
    </div>

    <div class="ui tiny basic modal delete-department-modal">
        <div class="ui icon header">
            <i class="trash icon"></i>
            Delete department
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
                Delete
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
            $('.delete-department, .edit-department').removeClass('disabled');
        });

        $('button.delete-department').click(function() {
            const departmentId = $('input[name="department"]').val();
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
            const departmentId = $('input[name="department"]').val();
            document.location = $('tr[data-id="' + departmentId + '"]').data('edit');
        });
    </script>
@endpush