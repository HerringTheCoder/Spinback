<div class="ui tiny modal new-resource-modal">
    <i class="close icon"></i>
    <div class="header">
        @lang('discs.new_disc')
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
                <label>@lang('discs.department')</label>
                <select class="ui search dropdown department-dropdown" name="department">
                    <option value="">@lang('discs.department')</option>
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
                    <label>@lang('discs.condition')</label>
                    <input type="text" name="condition" placeholder="@lang('discs.condition')">
                </div>
                <div class="field">
                    <label>@lang('discs.offer_price')</label>
                    <div class="ui right labeled input">
                        <input type="number" name="offer_price" placeholder="@lang('discs.offer_price')">
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
