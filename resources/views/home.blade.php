@extends('layouts.dashboard')

@section('content')
    <div class="ui grid">
        <div class="doubling four column row">
            <div class="four wide column">
                <div class="ui segment">
                    <h2>{{ $departments }}</h2>
                    departments
                </div>
            </div>
            <div class="four wide column">
                <div class="ui segment">
                    <h2>{{ $transactions }}</h2>
                    transactions
                </div>
            </div>
            <div class="four wide column">
                <div class="ui segment">
                    <h2>{{ $discs }}</h2>
                    discs
                </div>
            </div>
            <div class="four wide column">
                <div class="ui segment">
                    <h2>{{ $parcels }}</h2>
                    parcels
                </div>
            </div>
        </div>
    </div>
@endsection
