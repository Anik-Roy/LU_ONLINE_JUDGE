@extends('inc.app')
@section('head')
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
@endsection
@section('contant')

<div class="container mt-5">
    <div class="row justify-content=center p-5">
        {{$problem->title}}
        <br>
        {{$problem->time_limit}}
        <br>
        {{$problem->memory_limit}}
        
        <br>
        <br>
        <br>

        {{$problem->body}}
    </div>

    @php
        $input_outputs = $problem->inputoutput;
    @endphp

    @foreach ($input_outputs as $input_output)
        <div class="row">
            <div class="col">
                {{$input_output->input}}
            </div>
            <div class="col">
                {{$input_output->output}}
            </div>
        </div>
    @endforeach   
</div>
@endsection 


