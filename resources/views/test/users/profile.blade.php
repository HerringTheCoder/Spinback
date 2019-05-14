@extends('layouts.app')
@section('content')
    <table class="ui celled table">
        <thead>
        <tr><th>ID</th>
            <th>First name</th>
            <th>Last name</th>
        </tr></thead>
        <tbody>
<tr>
    <td data-label="ID">{{$user->id}}</td>
    <td data-label="First name">{{$user->first_name}}</td>
<td data-label="Last name">{{$user->last_name}}</td>
</tr>
        </tbody>
    </table>
        <form method="POST" action="{{route('users.update', $user->id)}}">
        @csrf
            @method('PUT')
           Change first name:<br>
            <input type="text" name="first_name"><br>
            Change last name:<br>
            <input type="text" name="last_name"><br>
            <input type="submit" value="Submit">
        </form>
@endsection
