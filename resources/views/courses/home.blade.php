@extends('inc.app')
@section('contant')

    <div class="container mt-5">

        @foreach ($courses as $course)
            <div class="card">
                <div class="card-header">
                        <a href="{{url($course->name.'/problemset')}}">
                            {{ $course->name }}
                        </a>
                </div>
                <div class="card-body" style="font-family: 'Ubuntu', sans-serif">
                    
                </div>
            </div>
            <br>
            <br>
        @endforeach
        
        
    </div>

@endsection
