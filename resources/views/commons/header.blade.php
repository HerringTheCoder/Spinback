<header class="header ">
    <div class="ui inverted secondary menu">
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
                    <input type="submit" class="ui inverted grey basic button" value="Logout">
                </form>
            </div>
        </div>
    </div>
</header>