@extends('layouts.app')
@section('content')
    <table class="ui celled table">
        <thead>
        <tr><th>ID</th>
            <th>Name</th>
            <th>Country</th>
        </tr></thead>
        <tbody>
<tr>
    <td data-label="ID">{{$artist->id}}</td>
    <td data-label="Name">{{$artist->name}}</td>
<td data-label="Country">{{$artist->country}}</td>
</tr>
        </tbody>
    </table>
        <form method="POST" action="{{route('artists.update', $artist->id)}}">
        @csrf
            @method('PUT')
           Change name:<br>
            <input type="text" name="name"><br>
            Change country:<br>
            <input type="text" name="country"><br>
            <input type="submit" value="Submit">
        </form>
@endsection
