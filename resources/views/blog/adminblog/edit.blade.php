@extends('inc.app')

@section('head')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{url('css/adminstyles.css')}}">
    <link rel="stylesheet" href="{{url('css/publicstyles.css')}}">
    <link rel="stylesheet" href="{{'font-awesome/css/font-awesome.min.css'}}">
    <link href="{{url('css/iziToast.css')}}" rel="stylesheet">
    <link href="{{url('css/iziToast.min.css')}}" rel="stylesheet">
    <script src="{{'js/jquery-3.3.1.min.js'}}"></script>
    <script src="{{'js/bootstrap.min.js'}}"></script>
    <script src="{{url('js/iziToast.js')}}"></script>
    <script src="{{url('js/iziToast.min.js')}}"></script>
@endsection

@section('contant')
    <div class="container-fluid">
        <div class="row">
            @if (session('message') == 'Post is edited successfully.')
                <script>
                    iziToast.success({
                        title: 'OK',
                        message: "{{session('message')}}",
                    });
                </script>

            @else
                @if(session('message') != null)
                    <script>
                        iziToast.error({
                            title: 'OK',
                            message: "{{session('msg')}}",
                        });
                    </script>
                @endif
            @endif
            <div class="col-sm-12">
                <h2>Edit Post</h2>

                <div>
                    <form action="{{url('post/edit/'.$post->id)}}" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label for="title"><span class="fieldInfo">Title:</span></label>
                                <input class="form-control" type="text" name="Title" id="title" value="{{$post->title}}"/>
                            </div>

                            <div class="form-group">
                                <label for="categoryselect"><span class="fieldInfo">Category:</span></label>
                                <select class="form-control" id="categoryselect" name="Category">
                                    @foreach($category as $cat)
                                        @if($cat->name == $post->category)
                                            <option selected>{{$cat->name}}</option>

                                        @else
                                            <option>{{$cat->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="imageselect"><span class="fieldInfo">Select Image:</span></label>
                                <input class="form-control" type="file" name="Image" id="imageselect">
                            </div>

                            <div class="form-group">
                                <label for="postarea"><span class="fieldInfo">Post:</span></label>
                                <textarea class="form-control" name="Post" id="postarea">{{$post->post}}</textarea>
                            </div>
                            <br/>
                            @csrf
                            <input style="margin-bottom:10px;" class="btn btn-success btn-block" type="submit" name="Submit" value="Edit Post">
                        </fieldset>
                    </form>
                </div>
            </div> <!--ending of main area-->
        </div> <!--ending of row-->
    </div> <!--ending of container-->
@endsection