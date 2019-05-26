<aside class="navigation">
    <div class="ui inverted vertical fluid menu">
        <a class="item close-menu">
            <i class="close icon"></i>
            <b>{{ __('dashboard.nav.close_menu') }}</b>
        </a>
        <a class="item logo-wrapper" href="/">
            <img src="{{ asset('images/spinback-alt.png') }}" class="logo">
        </a>
        <a class="item" href="{{ route('departments.index') }}">
            <b>{{ __('dashboard.nav.departments') }}</b>
        </a>
        <div class="item">
            <div class="header">
                {{ __('dashboard.nav.metadata') }}
            </div>
            <div class="menu">
                <div class="item">
                    {{ __('dashboard.nav.artists') }}
                </div>
                <div class="item">
                    {{ __('dashboard.nav.albums') }}
                </div>
            </div>
        </div>
        <div class="item">
            <b>{{ __('dashboard.nav.users') }}</b>
        </div>
        <a class="item" href="{{ route('about') }}">
            <b>{{ __('dashboard.nav.about') }}</b>
        </a>
    </div>
    
    <div style="clear: both;"></div>

</aside>