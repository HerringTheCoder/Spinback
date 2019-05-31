<div class="ui tabular menu">
    @if (request()->is('artists*'))
        <div class="item active">
            {{ __('dashboard.nav.artists') }}
        </div>
        <a href="{{ route('metadata.index') }}" class="item">
            {{ __('dashboard.nav.albums') }}
        </a>
    @else
        <a href="{{ route('artists.index') }}" class="item">
            {{ __('dashboard.nav.artists') }}
        </a>
        <div class="item active">
            {{ __('dashboard.nav.albums') }}
        </div>
    @endif
</div>