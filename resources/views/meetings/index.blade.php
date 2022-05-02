@extends('layouts.app')

@section('content')
    <h1>Meetings</h1>

    <ul class="list-group">
        @foreach($meetings as $meeting)
        <div class="list-group-item">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <a href="/meetings/{{$meeting->id}}">{{$meeting->title}}</a>
                    </div>
                    <div class="col">
                        <a href="/meetings/{{$meeting->id}}/delete">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </ul>
@endsection