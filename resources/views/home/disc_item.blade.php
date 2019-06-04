<a class="item" href="{{ route('discs.show', ['id' => $disc->id]) }}">
    <div class="ui tiny image">
        @if ($disc->album->cover)
            <img src="{{ $disc->album->image() }}">
        @endif
    </div>
    <div class="middle aligned content">
        <div class="ui small header">{{ $disc->album->title }}</div>
        <div class="meta">
            @if ($disc->sold)
            <i class="green check icon"></i>
            @endif
            in {{ $disc->department->name }} for {{ $disc->offer_price }} PLN
        </div>
        <div class="extra">
            {{ $disc->created_at->diffForHumans() }}
        </div>
    </div>
</a>
