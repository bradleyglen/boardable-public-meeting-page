@extends('layouts.app')

@section('content')
    <a href="/meetings">&lt; Back</a>

    <h1>{{$meeting->title}}</h1>

    <h5>Description:</h5>
    <div>{{$meeting->description}}</div>
    <h5 style="margin-top: 20px;">Location:</h5>
    <div>{{$meeting->location}}</div>
    <h5 style="margin-top: 20px;">Date/Time:</h5>
    <div>{{$meeting->start->format('Y M d @ H:i')}} - {{$meeting->end->format('Y M d @ H:i')}}</div>

    <!-- here is where a form allowing users to toggle on/off the public meeting page - you will need to handle that form inside of a controller -->
    @if (!$is_public)
    <h5 style="margin-top: 20px;">Settings:</h5>
    <form action="/meetings/{{$meeting->id}}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="public_path" name="public_path" value="{{$is_public ? 'true' : 'false'}}" />
        <div class="form-group">
            <label for="is_public">Public Agenda:</label>
            <input type="checkbox" id="is_public" name="is_public" value="is_public" {{ $meeting->is_public == 1 ? "checked" : "" }} />
        </div>
        <div class="form-group">
            <label for="agenda">Agenda</label>
            <textarea class="form-control" id="agenda" rows="3">{{ $meeting->agenda }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Save</button>
    </form>
    @else
        @if ($meeting->is_public == 1)
            <h5 style="margin-top: 10px;">Agenda:</h5>
            {{ $meeting->agenda }}
        @endif
    @endif
    @if ($is_public)
    <h5 style="margin-top: 20px;">Respond:</h5>
    <form action="/meetings_users" method="POST">
        @csrf
        <input type="hidden" id="public_path" name="public_path" value="{{$is_public ? 'true' : 'false'}}" />
        <input type="hidden" id="meeting_id" name="meeting_id" value="{{$meeting->id}}" />
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" />
        </div>
        <div class="form-group">
            <div>RSVP:</div>
            <input type="radio" class="form-check-input" id="rsvp-yes" name="rsvp" value="yes" checked />
            <label for="rsvp-yes" class="form-check-label">Yes</label>
            <input type="radio" class="form-check-input" id="rsvp-no" name="rsvp" value="no" />
            <label for="rsvp-no" class="form-check-label">No</label>
            <input type="radio" class="form-check-input" id="rsvp-maybe" name="rsvp" value="maybe" />
            <label for="rsvp-maybe" class="form-check-label">Maybe</label>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Save</button>
    </form>
    @endif
    <!-- here is where a list of emails with their RSVP status for this meeting will go -->
    <h2>RSVPs</h2>
    @foreach ($users as $user)
      <div>{{$user}}</div>
    @endforeach
@endsection