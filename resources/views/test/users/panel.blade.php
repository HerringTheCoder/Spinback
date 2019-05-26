@extends('layouts.app')
@section('content')
    <div class="ui message">Logged as: {{Auth::User()}}</div>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST"
          style="display: none;">
        @csrf
    </form>
    @isset($message)
        <div class="ui warning message">
            <i class="close link icon" onclick="window.location.reload()"></i>
            <div class="header">
                {{$message}}
            </div>
        </div>
    @endif


    <table class="ui celled table">
        <thead>
        <tr><th>First name</th>
            <th>Last name</th>
            <th>Action</th>
        </tr></thead>
        <tbody>
@foreach($users as $user)
<tr>
    <td data-label="First name">{{$user->first_name}}</td>
    <td data-label="Last name">{{$user->last_name}}</td>
    <td data-label="Action">
        <form method="POST" action="{{route('users.destroy', $user->id)}}">
            @csrf
            @method('DELETE')
            <button class="negative ui button" type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
        </tbody>
@endsection
