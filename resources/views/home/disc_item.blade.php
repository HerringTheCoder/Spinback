<a class="item" href="{{ route('discs.show', ['id' => $disc->id]) }}">
    <div class="ui tiny image">
        <img src="{{ $disc->album->image() }}">
    </div>
    <div class="middle aligned content">
        <div class="ui small header">{{ $disc->album->title }}</div>
        <div class="meta">
            @if ($disc->sold)
            <i class="green check icon"></i>
            @endif
            @lang('home.disc_meta', ['name' => $disc->department->name, 'price' => $disc->offer_price])
        </div>
        <div class="extra">
            {{ $disc->created_at->diffForHumans() }}
        </div>
    </div>
</a>
