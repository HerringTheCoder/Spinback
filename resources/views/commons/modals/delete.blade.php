<div class="ui tiny basic modal delete-modal">
    <div class="ui icon header">
        <i class="trash icon"></i>
        Removing resource
    </div>
    <div class="content">
        You're about to delete <strong></strong>. Are you sure?
    </div>
    <div class="actions">
        <div class="ui basic cancel inverted button">
            Cancel
        </div>
        <div class="ui red ok inverted button">
            <i class="trash icon"></i>
            Delete
        </div>
    </div>
    <form method="post">
        @csrf
        @method('delete')
    </form>
</div>

