@extends('inc.app')
@section('contant')

    <div class="container mt-4">


        @foreach ($decoded_data as $data)
            <div class="card">
                <div class="card-header">
                        <a href="{{$data->href}}">
                            {{ $data->event }}
                        </a>
                        <a href="{{$data->href}}" style="float:right">
                            {{ $data->resource->name }}
                        </a>
                </div>
                <div class="card-body p-0 pl-3 " style="font-family: 'Ubuntu', sans-serif;" >
                    @if ($data->resource->name == "codeforces.com")
                        <img class="img-fluid p-1" src="/img/codeforces.png" alt="codeforces" style="height: 80px">
                    @elseif($data->resource->name == "codechef.com")
                        <img class="img-fluid p-1" src="/img/codechef.png" alt="codechef" style="height: 100px">
                    @elseif($data->resource->name == "topcoder.com")
                        <img class="img-fluid p-1" src="/img/topcoder.png" alt="topcoder" style="height: 110px">
                    @elseif($data->resource->name == "hackerearth.com")
                        <img class="img-fluid p-3" src="/img/hackerearth.png" alt="hackerearth" style="height: 80px">
                    @elseif($data->resource->name == "hackerrank.com")
                        <img class="img-fluid p-1" src="/img/hackerrank.png" alt="hackerrank" style="height: 100px">
                    @endif
                    
                </div>
                <div class="card-footer justify-content-end">
                    <a href="#" style="float:left">
                        Start Time: {{$data->start}}
                    </a>
                    <a href="#"  style="float:right">
                        End Time: {{$data->end}}
                    </a>
                </div>
            </div>
        @endforeach
        
    </div>


@endsection
@section('head')
    <style>
    .card-img-top {
        min-width: 100%;
        width: auto;
        height: auto;
    }
    </style>
@endsection