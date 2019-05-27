@extends('inc.app')

@section('head')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{url('css/adminstyles.css')}}">
    <link rel="stylesheet" href="{{url('css/publicstyles.css')}}">
    <link rel="stylesheet" href="{{'font-awesome/css/font-awesome.min.css'}}">
    <script src="{{'js/jquery-3.3.1.min.js'}}"></script>
    <script src="{{'js/bootstrap.min.js'}}"></script>

    <style>
        .col-sm-8 {

        }

        .col-sm-3 {
            /* background-color: green;
            height: -moz-fit-content;
            height: fit-content; */
            display: table;
        }

        .blogpost {
            margin-bottom: 30px;
            display: table;
        }
    </style>
@endsection

@section('contant')
    <div class="container"><!--contaner area-->

        <div class="row"><!--row area-->
            <div class="col-sm-8"><!--main blog area-->

                    @foreach($allPost as $post)

                        <div class="blogpost">
                            <img src="{{asset('upload/'.$post->image)}}" class="img-fluid mx-auto d-block" alt="Responsive image"/>
                            <div class="caption">
                                <h3 id="heading">{{ htmlentities($post->title)}}</h3>
                                
                                <p class="description">Category:{{htmlentities($post->category)}}<span style="margin-left:5px; float:right;">Published on:
                                        {{ htmlentities($post->created_at) }}</span>
                                </p>

                                <p class="post"><?php
                                                    if(strlen($post->post) > 50) {
                                                        $p = substr($post->post, 0, 50)."...";
                                                        $flag = true;
                                                    }
                                                    else {
                                                        $p = $post->post;
                                                    }
                                                ?>

                                    {{ $p}}
                                </p>
                                
                            </div>

                            <a href="{{url('liveblogpost/'.$post->id)}}"><span class="btn btn-info" style="float:right">Read More &rsaquo;&rsaquo;</span></a>
                        </div>
                    @endforeach
            </div><!--main blog ending-->

            <div class="offset-sm-1 col-sm-3"><!--sidebar area-->

                <div class="sidebarpost img-thumbnail">
                    <h4>About Developer</h4>
                    <img style="width:100px; height:100px;" src="{{asset('img/avatars/6.jpg')}}" class="mx-auto d-block rounded-circle img-responsive"/>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam.</p>
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