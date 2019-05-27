@extends('inc.app')


@section('head')
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
  <link rel="stylesheet" type="text/css" media="screen" href="/css/dulon.css">
@endsection

@section('contant')
    <div class="container-fluid">
		<div class="card rounded shadow  border border-success">
			<ul class="menu mt-3">
				<li id="bg-efect">
					<div class="projects-item border-right">
						<a href="/ACM/problemset" class="menu_item">Problemset</a>
						<div class="overlay"></div>
					</div>
				</li>
				<li id="bg-efect">
					<div class="projects-item border-left border-right ml-2">
						<a href="/ACM/status" class="menu_item">Status</a>
						<div class="overlay"></div>
					</div>
				</li>
				<li id="bg-efect">
					<div class="menu_active  border-left border-right ml-2">
						<a href="/ACM/mysubmissions" class="menu_item">My Submissions</a>
						<div class="overlay"></div>
					</div>
				</li>
				<li id="bg-efect">
					<div class="projects-item border-left border-right ml-2">
						<a href="/ACM/standings" class="menu_item">Standings</a>
						<div class="overlay"></div>
					</div>
				</li>
				<li id="bg-efect">
					<div class="projects-item border-left border-right ml-2">
						<a href="/ACM/compiler" class="menu_item">Custom Test</a>
						<div class="overlay"></div>
					</div>
				</li>
			</ul>
		</div>
    </div>  
    <div class="container-fluid">
            <div class="card rounded shadow p-4"  style="font-family: 'Consolas'" id="viewcode">
                <table class="table-striped table-hover table-sm table-bordered text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>SUBMISSION TIME</th>
                            <th>Author</th>
                            <th>PROBLEM NAME</th>
                            <th>LANGUAGE</th>
                            <th>CPU</th>
                            <th>MEMORY</th>
                            <th>VERDICT</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($submissions as $submission)    
                            {{-- {{dd($submission->toArray())}} --}}
                            <tr>
                        
                                @php
                                    // $problem = \App\Problem::find($submission->problem_id);
                                    $problem = $submission->problem;
                                    //$author = \App\User::find($submission->author_id);
                                    $author = $submission->user;

                                    // dd($author->toArray());
                                @endphp

                                <td><a id="{{$submission->id}}" class="view_data" style="cursor:pointer; color: dodgerblue;">{{$submission->id}}</a></td>
                                <td> {{$submission->created_at}} </td>
                                <td><a href="/profile/{{$author->id}}">{{$author->name}}</a></td>
                                <td><a href="/ACM/problem/show/{{$problem->id}}">{{$problem->title}}</a></td>
                                <td> {{$submission->language}} </td>
                                <td> {{$submission->result}} </td>
                                <td> {{$submission->cpu}} ms </td>
                                <td> {{$submission->memory}} kb </td>
                            </tr>
                        @endforeach
                            
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-center">
                {{$submissions->links()}}
            </div>
            <div id="bootstrap-modal"  class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    
                    <div class="modal-content pl-5 pr-5">

                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Submit <strong>Make full modal on loadcontant file</strong> Solution</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <textarea id="code" cols="30" rows="10" class="showCode"></textarea>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>    
                    </div>
                </div>
            </div>
    </div>
    <script>
        $(document).ready(function(){  
            $('.view_data').click(function(){ 
                var exchange_id = $(this).attr("id"); 
                
                $.ajax({  
                    url:"/loadcontant",  
                    method:"get",  
                    data:{id:exchange_id}, 
                    success:function(data){  
                        $('#code').html(data);  
                        $('#bootstrap-modal').modal("show");
                    } 
                        
                });
            });  
        });
    </script>
@endsection

@section('body')
    <script src="/js/modernizr.custom.97074.js"></script>
    <script src="/js/jquery.hoverdir.js"></script>


    <script>
        $(function () {

            $('#bg-efect > .projects-item ').each(function () {
                $(this).hoverdir();
            });

        });
    </script>
@endsection

