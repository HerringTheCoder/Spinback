@extends('layouts.dashboard')

@section('title', __('transactions.edit_title'))
@section('content')
    <h3 class="ui dividing header">{{ __('transactions.edit_title') }}</h3>

    <form class="ui form" method="post" action="{{ route('transactions.update', ['id' => $transaction->id]) }}">
        @csrf
        @method('PATCH')
        <div class="field">
            <label>@lang('transactions.price')</label>
            <input type="text" name="price" placeholder="@lang('transactions.price')" value="{{ $transaction->price }}">
        </div>

        <div class="ui simple selection dropdown">
            <input type="hidden" name="operation_type">
            <i class="dropdown icon"></i>
            <div class="default text">
                @if($transaction->operation_type==='sale')@lang('transactions.sale')
                @elseif ($transaction->operation_type==='purchase')@lang('transactions.purchase')
                @endif
            </div>
            <div class="menu">
              <div class="item">@lang('transactions.sale')</div>
              <div class="item">@lang('transactions.purchase')</div>
            </div>
          </div>
        <button class="ui orange button" type="submit">@lang('transactions.save')</div>
    </form>
@endsection
