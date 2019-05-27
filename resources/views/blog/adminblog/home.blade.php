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

            @if (session('message') == 'Post is created successfully.')
                <script>
                    iziToast.success({
                        title: 'OK',
                        message: "{{session('message')}}",
                    });
                </script>

            @elseif(session('message') == 'Post is deleted successfully.')
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
                <h2>Admin Dashboard</h2>

                <div class="myTable table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th width=11%>Post Title</th>
                                <th width=11%>Date & Time</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Banner</th>
                                <th width=15%>Action</th>
                                <th width=14%>Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($allPost as $post)
                                <tr>
                                    <td>{{$post->id}}</td>

                                    <td style="color:#277273">
                                        {{$post->title}}
                                    </td>

                                    <td>
                                        {{$post->created_at}}
                                    </td>

                                    <td>{{$post->author}}</td>

                                    <td>
                                        {{$post->category}}
                                    </td>

                                    <td><img src="{{asset('upload/'.$post->image)}}" style="width:100px; height:50px"/></td>

                                    <td><a href="{{url('editpost/'.$post->id)}}" target="_blank" class="btn btn-warning"><span style="color:#fff">Edit</span></a> <a href="{{url('deletepost/'.$post->id)}}" target="_blank" class="btn btn-danger"><span style="color:#fff">Delete</span></a></td>

                                    <td><a href="{{url('liveblogpost/'.$post->id)}}" target="_blank" class="btn btn-primary"><span style="color:#fff">Live Preview</span></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!--ending of main area-->
        </div> <!--ending of row-->
    </div> <!--ending of container-->
@endsection
