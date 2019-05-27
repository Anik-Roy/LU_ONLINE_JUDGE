@extends('inc.app')

@section('head')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{url('font-awesome/css/font-awesome.min.css')}}">
    
    <style>
        .col-sm-8 {

        }

        .col-sm-3 {

        }

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

@section('contant')
    <div class="container"><!--contaner area-->
        <div class="row"><!--row area-->
            <div class="col-sm-8"><!--main blog area-->
                @php
                    $id = $post->id;
                    $datetime = $post->created_at;
                    $title = $post->title;
                    $category = $post->category;
                    $author = $post->author;
                    $image = $post->image;
                    $post = $post->post;
                @endphp

                <div class="blogpost">
                    <img src="{{asset('upload/'.$image)}}" class="img-fluid mx-auto d-block" alt="Responsive image"/>
                    <div class="caption">
                        <h3 id="heading">{{htmlentities($title)}}</h3>
                        <p class="description">Category:{{htmlentities($category)}}<span style="margin-left:5px; float:right;">Published on:
                                {{ htmlentities($datetime)}}</span>
                        </p>
                        <p class="post">{{$post}}</p>
                    </div>
                </div>

                <div class="commentHeader">
                    <span class="fieldInfo">Share your thoughts about this post...</span>
                    <br/>
                    <span class="fieldInfo">Your comment:</span>
                </div>

                <div>
                    <form action="{{route('commentstore', $id)}}" method="post">
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
                                <textarea class="form-control" name="body" id="commentarea"></textarea>
                            </div>
                            <br/>
                            <input style="margin-bottom:10px;" class="btn btn-primary btn-block" type="submit" name="Submit" value="Submit Comment">
                        </fieldset>
                    </form>
                </div>

                <h2 class="">Comments</h2>
	
                <div class="card" style="width:100%">
                    <div class="card-body">

                        @php
                            $comments = App\Comment::where('blog_id', $id)->paginate(15);
                            
                        @endphp

                        @foreach($comments as $comment)
                            @php
                                $user = App\User::find($comment->user_id);
                            @endphp

                            <div class="row">
                                <div class="col-md-2">
                                    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" width="80px" height="60px"/>
                                    <p class="text-secondary text-center" style="font-size: 10px">{{$comment->created_at}}</p>
                                </div>

                                <div class="col-md-10">
                                    <p>
                                        <a class="float-left" href=""><strong>{{$user->name}}</strong></a>
                                        {{--<span class="float-right"><i class="text-warning fa fa-star"></i></span>--}}
                                        {{--<span class="float-right"><i class="text-warning fa fa-star"></i></span>--}}
                                        {{--<span class="float-right"><i class="text-warning fa fa-star"></i></span>--}}
                                        {{--<span class="float-right"><i class="text-warning fa fa-star"></i></span>--}}
                                    </p>

                                    <div class="clearfix"></div>
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

                <!--Form div -->
                <br/><br/>
            </div><!--main blog ending-->

            <div class="offset-sm-1 col-sm-3"><!--sidebar area-->
                <div class="card">
                    <div class="card-header text-center">
                        About Developer
                    </div>
                </div>
                <div class="card-body">
                    <div class="sidebarpost img-thumbnail">
                        <img style="width:100px; height:100px;" src="{{asset('img/avatars/6.jpg')}}" class="mx-auto d-block rounded-circle img-responsive"/>
                        
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam.</p>
                    </div>
                </div>

                <div class="card text-black mb-3" style="max-width: 18rem;"> <!--categories-->
                    <div class="card-header bg-primary text-white">Categories</div>
                    <div class="card-body">
                        <!-- <h5 class="card-title">Primary card title</h5> -->

                        <div class="list-group">

                            @foreach($allCategory as $category)
                                <a href="" class="list-group-item list-group-item-action">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-primary">Footer</div>
                </div> <!--categories ending-->

                <div class="card text-black mb-3" style="max-width: 18rem;"> <!--recent post-->
                    <div class="card-header text-white bg-primary">Recent Post</div>

                    <?php
                    $recentPost = \App\Blog::orderBy('created_at', 'desc')->take(5)->get();

                    foreach ($recentPost as $rPost) {
                    $id = $rPost->id;
                    $datetime = $rPost->created_at;
                    $title = $rPost->title;
                    $image = $rPost->image;
                    $post = $rPost->post;

                    if(strlen($post) > 20) {
                        $post = substr($post, 0, 20)."...";
                    }

                    if(strlen($datetime) > 16) {
                        $datetime = substr($datetime, 0, 16)."...";
                    }
                    ?>

                    <div class="media" style="margin-top:10px;">
                        <img width="80px" height="80px" class="align-self-start mr-3" src="{{asset('upload/'.$image)}}" alt="Generic placeholder image"/>
                        <div class="media-body">
                            <h5 class="mt-0"><a href="{{url('liveblogpost/'.$id)}}"><p class="card-title heading">{{$title}}</p></a></h5>
                            <p class="card-text">{{$post}}</p>
                            <p class="card-text"><small class="text-muted">{{"Posted on: ".$datetime}}</small></p>
                        </div>
                    </div>
                    <div class="card-header bg-transparent border-primary"></div>
                    <?php
                    }
                    ?>
                </div> <!--recent post ending-->
            </div><!--sidebar ending-->
        </div><!--row ending-->
    </div><!--container ending-->
@endsection