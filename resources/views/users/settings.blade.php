@extends('layouts.dashboard')

@section('title', __('settings.title'))
@section('content')
    <div class="ui stackable grid">
        {{-- <div class="eight wide column">
            <h3 class="ui dividing header">Ustawienia</h3>

            <form class="ui form" method="post" action="{{ route('users.default_department') }}">
                <div class="field">
                    <label>
                        Default department
                        <i class="question circle icon" data-content="When selected, discs will be filtered by department by default"></i>
                    </label>
                    <select class="ui dropdown department-dropdown" name="department">
                        <option value="">Department</option>
                        <option value="0">None</option>
                        @foreach ($departments as $department)
                            @if ($department->id == request()->input('department'))
                                <option selected value="{{ $department->id }}">{{ $department->name }}</option>
                            @else
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <button class="ui primary button" type="submit">Zapisz</button>

            </form>
        </div> --}}

        <div class="eight wide column">
            <h3 class="ui dividing header">@lang('settings.change_password')</h3>

            <form class="ui form" method="post" action="{{ route('users.change_password') }}">
                @csrf
        
                <div class="field">
                    <label>@lang('settings.old_password')</label>
                    <input type="password" name="old_password" placeholder="@lang('settings.old_password')">
                </div>

                <div class="field">
                    <label>@lang('settings.new_password')</label>
                    <input type="password" name="new_password" placeholder="@lang('settings.new_password')">
                </div>

                <div class="field">
                    <label>@lang('settings.repeat_password')</label>
                    <input type="password" name="new_password_confirmation" placeholder="@lang('settings.repeat_password')">
                </div>

                <button class="ui primary button" type="submit">@lang('settings.save')</button>
            </form>
        </div>

    </div>
    
@endsection

@push('scripts')
    <script>
        $('.question.circle.icon').popup();
        // $('.department-dropdown').dropdown();
    </script>
@endpush