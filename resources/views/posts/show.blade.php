@extends('inc.app')
@section('contant')
    <div class="container">

        <div class="card">
            <div class="card-header">
                {{ $post->title }}

            </div>
            <div class="card-body">
                {{ $post->body }}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="commentHeader">
            <span class="fieldInfo">Share your thoughts about this post...</span>
            <br/>
            <span class="fieldInfo">Your comment:</span>
        </div>

        <div>
            <form action="{{route('Postcommentstore', $post->id)}}" method="post">
                @csrf

                <fieldset>

                    <!-- <div class="form-group">
                        <label for="name"><span class="fieldInfo">Name:</span></label>
                        <input class="form-control" type="text" name="Name" id="name" placeholder="Name"/>
                    </div>

                    <div class="form-group">
                        <label for="email"><span class="fieldInfo">Email:</span></label>
                        <input class="form-control" type="email" name="Email" id="email" placeholder="Email"/>
                    </div> -->

                    <div class="form-group">
                        <label for="commentarea"><span class="fieldInfo">Comment Box:</span></label>
                        <textarea class="form-control" name="body" id="commentarea" rows="6"></textarea>
                    </div>
                    <input style="margin-bottom:10px;" class="btn btn-primary form-group" type="submit" name="Submit" value="Submit Comment">
                </fieldset>
            </form>
        </div>

        <h2 class="">Comments</h2>
        @php
            $comments = App\Comment::where('post_id', $post->id)->paginate(15);
        @endphp

        @if (sizeof($comments) == 0)
            <h3 class="alert alert-warning">No comments yet.. </h3>
        @else
            <div class="card">
                <div class="card-body">
                    @php
                        $flg = 0;
                    @endphp
                    @foreach($comments as $comment)
                        @php
                            $user = App\User::find($comment->user_id);
                        @endphp
                        @if ($flg)
                            <hr>
                        @endif
                        @php
                            $flg = 1;
                        @endphp
                        <div class="row">
                            <div class="col-md-2">
                                <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" width="80px" height="60px"/>
                                <p class="text-dark mt-2" style="font-size: 11px">{{$comment->created_at}}</p>
                            </div>

                            <div class="col-md-10">
                                <p>
                                    <a class="float-left" href=""><strong>{{$user->name}}</strong></a>
                                    {{--<span class="float-right"><i class="text-warning fa fa-star"></i></span>--}}
                                    {{--<span class="float-right"><i class="text-warning fa fa-star"></i></span>--}}
                                    {{--<span class="float-right"><i class="text-warning fa fa-star"></i></span>--}}
                                    {{--<span class="float-right"><i class="text-warning fa fa-star"></i></span>--}}
                                </p>

                                <div class="clearfix" style="font-family: 'Ubuntu';"></div>
                                    <p>{{$comment->body}}</p>
                                    <p>
                                        {{--<a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>--}}
                                        {{--<a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>--}}
                                    </p>
                                </div>
                            </div>


                    @endforeach
                </div>
            </div>
        @endif

    </div>
@endsection

@section('head')
      <style>
        .fieldInfo {
            color: #1B8EB7;
            font-size: 18px;
        }

        .commentHeader {
            border:1px dashed #ddd;
            text-align: center;
            font-weight: bold;
        }

        .allComments img {
            width: 50px;
            height: 50px;
            /* border-radius: 50%; */
            float: left;
            margin-right: 10px;
        }

        /* .commentName h4 {
            font-size: 15px;
            font-weight: bold;
            font-style: italic;
            float: left;
            margin-right: 5px;
        }

        .commentName p {
            font-size: 15px;
        } */

        .div-Blur {
            -webkit-filter: blur(1px);
            -moz-filter: blur(1px);
            -ms-filter: blur(1px);
            -o-filter: blur(1px);
            filter: blur(1px);
            cursor:not-allowed;
        }

        .card-inner{
            margin-left: 4rem;
        }
    </style>
@endsection