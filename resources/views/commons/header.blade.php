<header class="header ">
    <div class="ui inverted secondary menu">
        <div class="ui grid mobile only item show-menu">
            <i class="content icon"></i>
        </div>
        <div class="item mobile-hidden">
            {{ __('dashboard.header.greeting') }}, {{ Auth::user()->full_name }}
        </div>
        <div class="right menu">
            <a class="item" href="{{ route('locale', ['locale' => 'pl']) }}">
                <i class="pl flag"></i> Polski
            </a>
            <a class="item" href="{{ route('locale', ['locale' => 'en']) }}">
                <i class="uk flag"></i> English
            </a>
            <div class="item">
                <form action="/logout" method="post">
                    @csrf
                    <input type="submit" class="ui inverted grey basic button" value="{{ __('dashboard.header.logout') }}">
                </form>
            </div>
        </div>
    </div>
</header>