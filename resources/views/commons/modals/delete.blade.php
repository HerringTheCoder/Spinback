<div class="ui tiny basic modal delete-modal">
    <div class="ui icon header">
        <i class="trash icon"></i>
        {{ __('resources.delete_modal_header') }}
    </div>
    <div class="content">
        {!! __('resources.delete_modal_text') !!}
    </div>
    <div class="actions">
        <div class="ui basic cancel inverted button">
            {{ __('resources.cancel_button') }}
        </div>
        <div class="ui red ok inverted button">
            <i class="trash icon"></i>
            {{ __('resources.delete_button') }}
        </div>
    </div>
    <form method="post">
        @csrf
        @method('delete')
    </form>
</div>

