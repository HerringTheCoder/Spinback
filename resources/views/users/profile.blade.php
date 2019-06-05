@extends('layouts.dashboard')

@section('title', __('users.title'))
@section('content')
    <h3 class="ui dividing header">{{ __('users.title') }}</h3>

    <table class="ui compact sortable selectable celled striped definition table users">
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>email</th>
                    </tr>
                </thead>
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->getFullNameAttribute()}}</td>
                        <td>{{$user->email}}</td>
                    </tr>
                </table>
@endsection
