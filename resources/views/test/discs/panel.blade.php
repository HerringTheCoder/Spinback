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
        <tr><th>title from metadata</th>
            <th>condition</th>
            <th>photo_path</th>
            <th>offer_price</th>
            <th>sold</th>
            <th>department_id</th>
        </tr></thead>
        <tbody>
@foreach($discs as $disc)
<tr>
    <td data-label="title from metadata">{{$disc->metadata->title}}</td>
    <td data-label="condition">{{$disc->condition}}</td>
    <td data-label="photo_path">{{$disc->photo_path}}</td>
    <td data-label="offer_price">{{$disc->offer_price}}</td>
    <td data-label="sold">{{$disc->sold}}</td>
    <td data-label="department_id">{{$disc->department_id}}</td>
    <td data-label="Action">
        <form method="POST" action="{{route('discs.destroy', $disc->id)}}">
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
