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
@endsection

@section('contant')
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-10">
                <h2>Add New Post</h2>
                <div>
                    <form action="{{url('/blog/store')}}" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label for="title"><span class="fieldInfo">Title:</span></label>
                                <input class="form-control" type="text" name="Title" id="title" placeholder="Title" required/>
                            </div>

                            <div class="form-group">
                                <label for="categoryselect"><span class="fieldInfo">Category:</span></label>
                                <select class="form-control" id="categoryselect" name="Category" required>

                                    @foreach($categories as $category)
                                            <option>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="imageselect"><span class="fieldInfo">Select Image:</span></label>
                                <input class="form-control" type="file" name="Image" id="imageselect">
                            </div>

                            <div class="form-group">
                                <label for="postarea"><span class="fieldInfo">Post:</span></label>
                                <textarea class="form-control" name="Post" id="postarea" required></textarea>
                            </div>
                            <br/>
                            @csrf
                            <input style="margin-bottom:10px;" class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Post">
                        </fieldset>
                    </form>
                </div>
            </div> <!--ending of main area-->
        </div> <!--ending of row-->
    </div> <!--ending of container-->
    </body>
    </html>

@endsection