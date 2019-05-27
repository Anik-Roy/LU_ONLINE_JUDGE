@extends('inc.app')


@section('head')
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" media="screen" href="/css/dulon.css">
		<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
@endsection

@section('contant')
	<div class="container-fluid">
		<div class=" card rounded shadow">
			<ul class="menu mt-3">
				<li id="bg-efect">
					<div class="projects-item border-right">
						<a href="{{ route('sessionProblemset', ['session_name'=>$session_name, 'course_name'=>$course_name]) }}" class="menu_item">Problemset</a>
						<div class="overlay"></div>
					</div>
				</li>
				<li id="bg-efect">
					<div class="projects-item border-left border-right ml-2">
						<a href="{{ route('sessionSubmissions', ['session_name'=>$session_name, 'course_name'=>$course_name]) }}" class="menu_item">Status</a>
						<div class="overlay"></div>
					</div>
				</li>
				<li id="bg-efect">
					<div class="projects-item border-left border-right ml-2">
						<a href="{{ route('sessionMySubmissions', ['session_name'=>$session_name, 'course_name'=>$course_name]) }}" class="menu_item">My Submissions</a>
						<div class="overlay"></div>
					</div>
				</li>
				<li id="bg-efect">
					<div class="menu_active border-left border-right ml-2">
						<a href="{{ route('sessionStandings', ['session_name'=>$session_name, 'course_name'=>$course_name]) }}" class="menu_item">Standing</a>
						<div class="overlay"></div>
					</div>
				</li>
				<li id="bg-efect">
					<div class="projects-item border-left border-right ml-2">
						<a href="{{ route('sessionCompiler', ['session_name'=>$session_name, 'course_name'=>$course_name]) }}" class="menu_item">Custom Test</a>
						<div class="overlay"></div>
					</div>
				</li>
				<li id="bg-efect">
					<div class="projects-item border-left ml-2">
						<a href="{{ route('sessionMembers', ['session_name'=>$session_name, 'course_name'=>$course_name]) }}" class="menu_item">Enrolled Users</a>
						<div class="overlay"></div>
					</div>
				</li>
			</ul>
		</div>
	</div>


    <div class="container-fluid mt-4">
			<div class="card rounded shadow  callout-bordered callout-info">
				<div class="card-header">
					Standing of this session
				</div>
				<div class="card-body" style="overflow-x: auto">
					<table class="table table-striped table table-hover table-bordered" >
						<thead class="bg-gray-dark text-white" >
							<tr >
								<th class="text-center"> # </th>
								<th class="text-center"> Name </th>
								<th class="text-center">
									Solved
                                </th>
								@foreach ($problems as $problem)
									@php
										$assignment = "";
										if ($problem->level == "Assignment") {
											$assignment = "bg-success";
											// $assignment = "bg-gray-400";
										}
									@endphp
									<th class="text-center {{$assignment}}">
										<a href="{{ url($session_name.'/'.$course_name.'/problem/show/'.$problem->id) }}"  style="width: 40px;">
											<span title="{{$problem->title}}" class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="Tooltip on top"> {{$problem->id}}</span>
										</a>
										
                                    </th>
                                @endforeach
								{{-- <th style="width: 9%;" class="text-center">
									<span title="Tried"><a href="#"><i class="fas fa-warning" style="color: orangered"></i></a></span>
								</th> --}}
							</tr>
						</thead>
						<tbody>
							
							{{--{{count($problems)}}--}}

							@if(count($users) > 0)
								@php
									$cnt = 1;
								@endphp
								@foreach ($arr_users as $key => $arr_user)
									@php
										$user = App\User::find($key);
									@endphp
									<tr>
										<td style="width: 3%; text-align: center;">{{$cnt++}}</td>
										<td>
											<a href="/profile"> {{$user->name}} </a>
										</td>
										<td style="width: 5%; text-align: center"> {{$arr_user}} </td>
										@foreach ($problems as $col => $problem)
											@php
												$assignment = "";
												$color = "green";
												if ($problem->level == "Assignment") {
													$assignment = "bg-success border border-bottom";
													$color = "white";
													// $assignment = "bg-gray-400";
												}
											@endphp
											<td class="text-center {{$assignment}} ">
												{{--  <a href="http://">{{$problem->id}} | {{ $user->id}} </a> --}}
												@if ( isset($arr_ac[$problem->id][$user->id]) )
													{{-- <a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/AC/'.$code_link[$problem->id][$user->id]) }}"><i class="fas fa-check solved" style="color:green"></i></a> --}}
													<a id="{{$code_link[$problem->id][$user->id]->submission_id}}" class="view_data" style="cursor:pointer;"><i class="fas fa-check solved" style="color:{{$color}}"></i></a>
												@endif
											</td>
										@endforeach
										
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</span>
			</div>
			<div id="bootstrap-modal"  class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					
					<div class="modal-content pl-5 pr-5">

						<div class="modal-header">
							<h4 class="modal-title" id="exampleModalLongTitle">Soulution</h4>
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
			<script>
				$(document).ready(function(){  
					$('.view_data').click(function(){ 
						console.log(print);
						
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
    </div>
@endsection

@section('body')
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script src="/js/modernizr.custom.97074.js"></script>
    <script src="/js/jquery.hoverdir.js"></script>


    <script>
        $(function () {

            $(' #bg-efect > .projects-item ').each(function () {
                $(this).hoverdir();
            });

        });
    </script>
@endsection