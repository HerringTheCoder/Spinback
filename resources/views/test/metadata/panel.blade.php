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
        <tr><th>Title</th>
            <th>Artist_ID</th>
            <th>Genre</th>
            <th>Country</th>
            <th>Release Year</th>
            <th>Format</th>
        </tr></thead>
        <tbody>
@foreach($metatable as $metadata)
<tr>
    <td data-label="Title">{{$metadata->title}}</td>
    <td data-label="Artist_ID">{{$metadata->artist->name}}</td>
    <td data-label="Genre">{{$metadata->genre}}</td>
    <td data-label="Country">{{$metadata->country}}</td>
    <td data-label="Release Year">{{$metadata->release_year}}</td>
    <td data-label="Format">{{$metadata->format}}</td>
    <td data-label="Action">
        <form method="POST" action="{{route('metadata.destroy', $metadata->id)}}">
            @csrf
            @method('DELETE')
            <button class="negative ui button" type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
        </tbody>
    </table>
@endsection
