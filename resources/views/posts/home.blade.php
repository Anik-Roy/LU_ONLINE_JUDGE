@extends('inc.app')
@section('contant')

    <div class="container mt-5">

        @if (session('message'))
            <div>
                @if (session('message') == 'Post is added successfully')
                    <p class="alert alert-success animated jello" id="elem">
                        {{session('message')}}
                        <span class="float-right" onclick="fun()" style="cursor: pointer">
                            ×
                        </span>
                    </p>
                @else
                    <p class="alert alert-danger animated bounce" id="elem">{{session('message')}}
                    <span class="float-right" onclick="fun()" style="cursor: pointer">
                            ×
                        </span>
                    </p>
                @endif
            </div>
            <script>
                function fun() {
                    document.getElementById("elem").classList.add("lightSpeedOut");
                    document.getElementById("elem").classList.add("fast");
                    setInterval(myTimer, 1500);
                }
                function myTimer() {
                    document.getElementById("elem").style.display = "none";
                }
            </script>
        @endif

        @foreach ($posts as $post)
            <div class="card rounded">
                <div class="card-header">
                    <div class="float-left">
                        <h5>
                            <a class="font-weight-bold" href="{{url('/show/'.$post->id)}}">
                                {{ $post->title }}
                            </a>    
                        </h5> 
                    </div>
                    @if ($post->user->id == Auth::user()->id || Auth::user()->admin)  
                        <div class="float-right">
                            <a href=" {{url('/edit/'.$post->id)}}" class="btn btn-success">
                                Edit
                            </a>
                            <a href="{{url('/delete/'.$post->id)}}" class="btn btn-danger">
                                Delete
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body" style="font-family: 'Ubuntu', sans-serif">
                    {{-- {{ $post->body }} --}}
                    {{ str_limit(strip_tags($post->body), 200) }}
                    <br>
                    @if (strlen(strip_tags($post->body)) > 200)
                    {{-- ... <a href="{{ action('PostsController@show', $post) }}" class="btn btn-info btn-sm">Read More</a> --}}
                        <a href=" {{url('/show/'.$post->id)}}" class="btn btn-secondary btn-sm float-right">
                            Read more
                        </a>
                    @endif
                </div>
                <div class="card-footer">
                    <div>
                        <div class="float-left">
                            <a href="#"><i class="fas fa-user"></i></a>
                            <a href="profile/{{$post->user->id}}">{{$post->user->name }}</a>
                            <span class="mx-2"><i class="far fa-calendar-alt"></i> {{$post->updated_at->diffForHumans()}}</span>
                            {{-- <a href="#" class="mx-1"><i class="far fa-calendar-alt"></i> {{$post->updated_at->diffForHumans()}}</a> --}}
                            <a href="#" class="mx-1"><i class="fab fa-facebook-square"></i></a>
                            <a href="#" class="mx-1"><i class="fab fa-twitter-square"></i></a>
                            <a href="#" class="mx-1"><i class="fab fa-facebook-square"></i></a>
                        </div>
                        <div class="float-right">
                            <a href="#" class="mr-3"><i class="fas fa-heart"></i> 26</a>
                            <a href="#"><i class="fas fa-comments"></i> {{count($post->comments)}}</a>
                        </div>

                    </div>
                    
                </div>
            </div>
        @endforeach
        
        <div class="row justify-content-center">
            {{$posts->links()}}
        </div>
    </div>

@endsection
