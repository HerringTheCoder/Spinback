@extends('layouts.app')
@section('content')
    <table class="ui celled table">
        <thead>
        <tr><th>First name</th>
            <th>Last name</th>
            <th>Action</th>
        </tr></thead>
        <tbody>
<tr>
    <td data-label="ID">{{$user->id}}</td>
    <td data-label="First name">{{$user->first_name}}</td>
<td data-label="Last name">{{$user->last_name}}</td>
</tr>
        </tbody>
@endsection
