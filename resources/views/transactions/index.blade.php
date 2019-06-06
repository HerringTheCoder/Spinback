@extends('layouts.dashboard')

@section('title', __('transactions.title'))
@section('content')
    <h3 class="ui dividing header">{{ __('transactions.title') }}</h3>

    <div class="resource">
        <div class="controls">
            <button class="ui primary button new-transaction">
                @lang('transactions.new_transaction')
            </button>
            <button class="ui button disabled edit-resource">
                <i class="edit icon"></i>
                {{ __('resources.edit_button') }}
            </button>
            <button class="ui button disabled delete-resource">
                <i class="trash icon"></i>
                {{ __('resources.delete_button') }}
            </button>
            <a href="{{route('report')}}"><button class="ui green button right"> @lang('transactions.report')</button></a>
        </div>

        <table class="ui compact sortable selectable celled striped definition table transactions">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>@lang('transactions.department')</th>
                    <th>@lang('transactions.operation_type')</th>
                    <th>@lang('transactions.price')</th>
                    <th>@lang('transactions.employee')</th>
                    <th>@lang('transactions.disc')</th>
                    <th class='center aligned'>@lang('transactions.payment_type')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr
                        data-id="{{ $transaction->id }}"
                        data-delete-route="{{ route('transactions.destroy', ['id' => $transaction->id]) }}"
                        data-edit-route="{{ route('transactions.edit', ['id' => $transaction->id]) }}"
                        data-name="{{ $transaction->id}}">
                        <td class="collapsing ignored">
                            <div class="ui radio checkbox">
                                <input type="radio" name="transactions" id="radio"><label></label>
                            </div>
                        </td>
                        </td>
                        <td data-label="#" data-sort-value="{{ $transaction->id }}">{{ $transaction->id }}</td>
                        <td data-label="Department">{{ $transaction->department->name }}</td>
                        <td data-label="Operation_Type">@if($transaction->operation_type==='sale')@lang('transactions.sale')
                                @elseif ($transaction->operation_type==='purchase')@lang('transactions.purchase')
                                @endif</td>
                                <td data-label="Price">{{$transaction->price}}</td>
                                <td data-label="Employee">{{$transaction->user->getFullNameAttribute()}}</td>
                                <td data-label="Disc"><a href={{ route('discs.show', ['id' => $transaction->disc]) }}>{{$transaction->disc->album->title}}</a></td>
                                    <td class="center aligned" data-label="Payment_Type">
                                        @if($transaction->payment_type==='cash')<div class='ui icon' data-tooltip="@lang('transactions.cash')"><i class="large money bill alternate outline green icon" ></i></div>
                                        @elseif($transaction->payment_type==='credit card')<div class='ui icon' data-tooltip="@lang('transactions.credit_card')"><i class="large credit card outline yellow icon"></i></div>
                                            @endif </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="controls">
            <button class="ui primary button new-transaction">
                @lang('transactions.new_transaction')
            </button>
            <button class="ui button disabled edit-resource">
                <i class="edit icon"></i>
                {{ __('resources.edit_button') }}
            </button>
            <button class="ui button disabled delete-resource">
                <i class="trash icon"></i>
                {{ __('resources.delete_button') }}
            </button>
        </div>

        <div class="ui tiny modal new-transaction-modal">
            <i class="close icon"></i>
            <div class="header">
                @lang('transactions.new_transaction')
            </div>

            <div class="content">
                <form class="ui form new-transaction-form" method="post" action="{{ route('transactions.store') }}">
                    @csrf
                    <div class="two fields">
                    <div class="field">
                        <label>@lang('transactions.disc') <i class="music icon orange"></i></label>
                        <input type="number" name="disc_id" placeholder="@lang('transactions.disc')">
                    </div>
                    <div class="field">
                            <label>@lang('transactions.price') <i class="dollar sign icon green"></i></label>
                            <input type="text" name="price" placeholder="@lang('transactions.price')">
                        </div>
                    </div>
                    <div class="field">
                            <label>@lang('transactions.department') <i class="home icon blue"></i></label>
                        <div class="ui search selection dropdown">
                                <input type="hidden" name="department_id">
                                <i class="dropdown icon"></i>
                                <div class="default text">
                                    @lang('transactions.department')
                                </div>
                                <div class="menu">
                                    @foreach($departments as $department)
                                <div class="item" data-value="{{$department->id}}" data-tooltip="{{$department->address}}, {{$department->city}}, {{$department->phone_number}}">
                                    {{$department->name}}</div>
                                    @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="two fields">
                            <div class="field">
                                <label>@lang('transactions.sale')/@lang('transactions.purchase')</label>
                            <div class="ui selection dropdown">
                                    <input type="hidden" name="operation_type">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">
                                        @lang('transactions.sale')/@lang('transactions.purchase')
                                    </div>
                                    <div class="menu">
                                      <div class="item" data-value="sale">@lang('transactions.sale')</div>
                                      <div class="item" data-value="purchase">@lang('transactions.purchase')</div>
                                    </div>
                            </div>
                        </div>

                        <div class="field">
                                <label>@lang('transactions.payment_type')</label>
                            <div class="ui selection dropdown">
                                    <input type="hidden" name="payment_type">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">
                                        @lang('transactions.credit_card')/@lang('transactions.cash')
                                    </div>
                                    <div class="menu">
                                    <div class="item" data-value="cash">@lang('transactions.cash') <i class="money bill alternate outline green icon" ></i></div>
                                      <div class="item" data-value="credit card">@lang('transactions.credit_card') <i class="credit card outline yellow icon"></i></div>
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

        @include('commons.modals.delete')
@endsection

@push('scripts')
    <script>

        $('.ui.dropdown').dropdown();
        $('table.transactions').tablesort();
        $('button.new-transaction').click(function() {
            $('.new-transaction-modal')
                .modal({
                    onApprove: function() {
                        $('.new-transaction-form').submit();
                    }
                })
                .modal('show');
        });
    </script>
@endpush
