@if ($message = Session::get('success'))
    <div class="ui positive message">
        <i class="close icon"></i>
        <div class="header">
            @lang('messages.success')
        </div>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="ui error message">
        <i class="close icon"></i>
        <div class="header">
            @lang('messages.error')
        </div>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="ui yellow message">
        <i class="close icon"></i>
        <div class="header">
            @lang('messages.warning')
        </div>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="ui message">
        <i class="close icon"></i>
        {{ $message }}
    </div>
@endif

@if ($errors->any())
    <div class="ui error message">
        <i class="close icon"></i>
        <div class="header">
            @lang('messages.error')
        </div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif