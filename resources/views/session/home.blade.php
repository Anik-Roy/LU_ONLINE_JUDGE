@extends('inc.app')

@section('contant')
    {{-- <div class="card"> --}}
        <div class="card">
            <div class="card-header">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label onclick="document.location.href='/home'" id="all" class="btn {{Request::is('home') ? 'btn-success active' : 'btn-dark'}}" style="cursor: pointer">
                        <input type="radio" name="options" id="option1" autocomplete="on" {{Request::is('home') ? 'checked' : ''}}> All Sessions
                    </label>
                    <label onclick="document.location.href='/home/my'" id="my" class="btn {{Request::is('home') ? 'btn-dark' : 'btn-success active'}}" style="cursor: pointer">
                        <input type="radio" name="options" id="option2" autocomplete="on" {{Request::is('home') ? '' : 'checked'}}> My Sessions
                    </label>
                    <script>
                        $(document).ready(function () {
                            $("#my").click(function(){
                                console.log("lfa");
                                $("#my").removeClass("btn-dark");
                                $("#my").addClass("btn-success");
                                $("#all").removeClass("btn-success");
                                $("#all").addClass("btn-dark");

                            })
                            $("#all").click( function(){
                                $("#all").removeClass("btn-dark");
                                $("#all").addClass("btn-success");
                                $("#my").removeClass("btn-success");
                                $("#my").addClass("btn-dark");
                            })
                        })
                    </script>
                </div>
                @if (Auth::user()->admin)            
                    <a href="{{url('/session/create')}}" class="btn btn-primary" style="float:right">Create New Session</a>
                @endif
            </div>
            <div class="card-body">

                @foreach ($sessions as $session)
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left mt-2">
                                <h5>
                                    <a href="{{url($session->name.'/'.$session->course->name.'/problemset')}}">{{ $session->name }}</a>
                                </h5>
                            </div>
                            @if (Auth::user()->admin)
                                <div class="float-right">
                                    <a href="{{url($session->name.'/'.$session->course->name.'/security/'.$session->hash_code)}}" class="btn btn-dark float-right" target="_blank">Session Enroll Link</a>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="float-left">
                                    <label>Course Name: <span>{{$session->course->name}}</span></label>
                                    <br>
                                    <label>Batch:</label>
                                    <span>{{$session->batch}}</span>
                                    <br>
                                    <label>Section:</label>
                                    <span>{{$session->section}}</span>
                                    
                                </div>
                            <img class="img-fluid float-right" src="/img/{{$session->course->name}}.jpg" alt="{{$session->course->name}}" height="11%" width="11%">
                            </div>
                        </div>
                        <div class="card-footer">
                            @php
                                $author = App\Session::find($session->id)->user;
                            @endphp
                            {{$author->name}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    {{-- </div> --}}

@endsection

@section('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection

@section('sidebar')
        @include('inc.defaultSidebar')
@endsection