@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('users.store')}}">
@csrf
@method('POST')
Create a new user<br>
Login:<br>
<input type="text" name="login"><br>
Password:<br>
<input type="password" name="password"><br>
First name:<br>
<input type="text" name="first_name"><br>
Last name:<br>
<input type="text" name="last_name"><br>
Email:<br>
<input type="text" name="email"><br>
<input type="submit" value="Submit"><br>
</form>
@endsection
