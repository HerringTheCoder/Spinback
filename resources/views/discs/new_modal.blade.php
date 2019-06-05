<div class="ui tiny modal new-resource-modal">
    <i class="close icon"></i>
    <div class="header">
        New disc
    </div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('discs.store') }}">
            @csrf
            <input type="hidden" name="album">
            <div class="field">
                <label>Album</label>
                <div class="ui search album-search">
                    <input class="prompt" type="text" placeholder="Album">
                    <div class="results"></div>
                </div>
            </div>
            <div class="field">
                <label>Oddział</label>
                <select class="ui search dropdown department-dropdown" name="department">
                    <option value="">Department</option>
                    @foreach ($departments as $department)
                        @if ($department->id == request()->input('department'))
                            <option selected value="{{ $department->id }}">{{ $department->name }}</option>
                        @else
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Condition</label>
                    <input type="text" name="condition" placeholder="Condition">
                </div>
                <div class="field">
                    <label>Offer price</label>
                    <div class="ui right labeled input">
                        <input type="text" name="offer_price" placeholder="Offer price">
                        <div class="ui label">
                            PLN
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="actions">
        <div class="ui deny button">
            {{ __('resources.cancel_button') }}
        </div>
        <div class="ui positive button">
            <i class="save icon"></i>
            {{ __('resources.save_button') }}
        </div>
    </div>
</div>