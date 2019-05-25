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
        <tr><th>Name</th>
            <th>City</th>
            <th>Address</th>
            <th>Action</th>
        </tr></thead>
        <tbody>
@foreach($departments as $department)
<tr>
    <td data-label="Name">{{$department->name}}</td>
    <td data-label="City">{{$department->city}}</td>
    <td data-label="Address">{{$department->address}}</td>
    <td data-label="Action">
        <form method="POST" action="{{route('departments.destroy', $department->id)}}">
            @csrf
            @method('DELETE')
            <button class="negative ui button" type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
        </tbody>
@endsection
