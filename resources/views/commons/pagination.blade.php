@if ($paginator->hasPages())
    <div class="pagination">
        @if ($paginator->onFirstPage())
            <button class="ui left floated disabled button">
                <i class="angle left icon"></i>
                Previous
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">
                <button class="ui left floated button">
                    <i class="angle left icon"></i>
                    Previous
                </button>
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">
                <button class="ui right floated button">
                    Next
                    <i class="angle right icon"></i>
                </button>
            </a>
        @else
            <button class="ui right floated disabled button">
                Next
                <i class="angle right icon"></i>
            </button>
        @endif
    </div>
@endif