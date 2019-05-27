@extends('inc.app')

@section('notification')

    {{-- @php
        $notifications = App\Notification::where('user_id', $user_id)->where('is_seen', 0)->get();

    @endphp --}}

    {{-- <span class="badge badge-pill badge-danger">{{count($notifications)}}</span> --}}
@endsection

@section('notificationheader')
    {{-- {{"You have ". count($notifications). " notifications"}} --}}
@endsection

@section('notification_info')
    {{-- @foreach($notifications as $notification)
        <a class="dropdown-item" href="{{url('liveblogpost/'.$notification->blog_id)}}">
            @php
                $user = App\User::find($notification->user_id);
            @endphp

            {{$user->name. " commented on your post"}}</a>
    @endforeach --}}
@endsection

@section('contant')
        <div class="card alert alert-success">
            You Have Successfully Enrolled this course!
        </div>
@endsection

@section('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection

@section('sidebar')
        @include('inc.defaultSidebar')
@endsection