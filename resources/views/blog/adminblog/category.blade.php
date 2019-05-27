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
    <div class="card text-center font-weight-bolder card-accent-success ml-3 mr-3" >
        <legend>Manage Categories</legend>
    </div>
    <div class="container-fluid">
        <div class="row">
            @if (session('message') == 'Category is created successfully')
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
                <div>
                    <form action="{{url('/blog/create')}}" method="post">
                        <div class="form-group p-3">
                            <fieldset>
                                <label for="categoryname"><span class="fieldInfo">Name:</span></label>
                                <div class="row">
                                    <input class="form-control col-md-8" type="text" name="category" id="categoryname" required/>
                                    <input class="btn btn-success offset-1 col-md-3 pl-2" type="submit" name="Submit" value="Add New Category">
                                </div>
                            </fieldset>
                        </div>
                        @csrf
                    </form>
                </div>

                <div class="myTable table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Date & Time</th>
                            <th>Category Name</th>
                            <th>Creator Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($allCategory as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->created_at}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->creatorname}}</td>
                                    <td><button id="{{$category->id}}" onclick="confirmDialog(this.id);" class="btn btn-danger">Delete</button></td>

                                    <script>
                                        function confirmDialog(ID) {
                                            console.log(ID);
                                            var r = confirm("Are you sure to delete this category?");
                                            if (r === true) {
                                                let url = "{{ route('dCategory', ':id') }}";
                                                url = url.replace(':id', ID);
                                                document.location.href=url
                                            } else {

                                            }
                                        }
                                    </script>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!--ending of main area-->
        </div> <!--ending of row-->
    </div> <!--ending of container-->
@endsection