<aside class="navigation">
    <div class="ui inverted vertical fluid menu">
        <a class="item close-menu">
            <i class="close icon"></i>
            <b>{{ __('dashboard.nav.close_menu') }}</b>
        </a>
        <a class="item logo-wrapper" href="/">
            <img src="{{ asset('images/spinback-alt.png') }}" class="logo">
        </a>
        <a class="item {{ request()->is('departments*') ? 'active' : '' }}" href="{{ route('departments.index') }}">
            <b>{{ __('dashboard.nav.departments') }}</b>
        </a>
        <div class="item">
            <div class="header">
                {{ __('dashboard.nav.metadata') }}
            </div>
            <div class="menu">
                <a class="item {{ request()->is('artists*') ? 'active' : '' }}" href="{{ route('artists.index') }}">
                    {{ __('dashboard.nav.artists') }}
                </a>
                <a class="item {{ request()->is('albums*') ? 'active' : '' }}" href="{{ route('albums.index') }}">
                    {{ __('dashboard.nav.albums') }}
                </a>
            </div>
        </div>
        <a class="item {{ request()->is('discs*') ? 'active' : '' }}" href="{{ route('discs.index') }}">
            <b>{{ __('dashboard.nav.discs') }}</b>
        </a>
        <a class="item {{ request()->is('transactions*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                <b>{{ __('dashboard.nav.transactions') }}</b>
            </a>
        <a class="item {{ request()->is('parcels*') ? 'active' : '' }}" href="{{ route('parcels.index') }}">
                <b>{{ __('dashboard.nav.parcels') }}</b>
            </a>
        <div class="item">
            <b>{{ __('dashboard.nav.users') }}</b>
        </div>
        <a class="item {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">
            <b>{{ __('dashboard.nav.about') }}</b>
        </a>
    </div>

    <div style="clear: both;"></div>

    <footer>
        <i class="copyright outline icon"></i> Spinback {{ date('Y') }}
    </footer>
</aside>
