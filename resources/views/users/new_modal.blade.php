<div class="ui tiny modal new-resource-modal">
    <i class="close icon"></i>
    <div class="header">
        @lang('users.new_user')
    </div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('users.store') }}">
            @csrf
            <div class="field">
                <label>Login</label>
                <input type="text" name="login" placeholder="Login">
            </div>
            <div class="two fields">
                <div class="field">
                    <label>@lang('users.first_name')</label>
                    <input type="text" name="first_name" placeholder="@lang('users.first_name')">
                </div>
                <div class="field">
                    <label>@lang('users.last_name')</label>
                    <input type="text" name="last_name" placeholder="@lang('users.last_name')">
                </div>
            </div>
            <div class="field">
                <label>@lang('users.password')</label>
                <input type="text" name="password" placeholder="@lang('users.password')" value="{{ bin2hex(openssl_random_pseudo_bytes(4)) }}">
            </div>
            <div class="field">
                <label>Email</label>
                <input type="text" name="email" placeholder="Email">
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="send_email" tabindex="0" class="hidden">
                    <label>@lang('users.send_email')</label>
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

@push('scripts')
    <script>
        $('.ui.checkbox').checkbox();
    </script>
@endpush