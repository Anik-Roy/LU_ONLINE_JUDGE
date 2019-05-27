
@extends('inc.app')


@section('head')
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" media="screen" href="/css/dulon.css">
@endsection

@section('contant')
	<div class="container-fluid">
		<div class="card rounded shadow  border border-success">
			<ul class="menu mt-3">
				<li id="bg-efect">
					<div class="menu_active border-right">
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
					<div class="projects-item border-left border-right ml-2">
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
			@if (Auth::user()->admin)	
				<div class="card rounded shadow  callout-bordered callout-info">
					<div class="card-header">
						First solve the problem then write the code
							<a href="{{url($session_name.'/'.$course_name.'/problem/create')}}" class="btn btn-primary" style="float:right;"> Create New Problem </a>
							<a href="{{url($session_name.'/'.$course_name.'/selectproblem')}}" class="btn btn-primary" style="float:right; margin-right: 5px"> Select Existing Problem </a>
					</div>
					<div class="card-body">
						<table class="table table-striped table table-hover table-bordered">
							<thead class="bg-dark text-white">
								<tr>
									<th style="width:5%" class="text-center">#</th>
									<th class="text-center">
										PROBLEM TITLE
									</th>
									<th style="width: 9%;" class="text-center">
										<span title="Solved"><a href="#"><i class="fas fa-check solved" style="color:greenyellow"></i></a></span>
									</th>
									<th style="width: 9%;" class="text-center">
										<span title="Tried"><a href="#"><i class="fas fa-warning" style="color:orangered"></i></a></span>
									</th>
								</tr>
							</thead>
							<tbody>

								{{--{{count($problems)}}--}}

								@if(count($problems) > 0)
									@foreach ($problems as $problem)
										@php
											$cls = "";
											$color = "";
											$color2 = "dimgray";
											if($problem->level == "Assignment") {
												$cls = "bg-success text-white";
												$color = "white";
												$color2 = "yellow";
											}
										@endphp								
										<tr class="{{$cls}}">
											<td class="text-center"> {{$problem->id}} </td>
											<td>
												<a href="{{ url($session_name.'/'.$course_name.'/problem/show/'.$problem->id) }}" style="color:{{$color}}"> {{$problem->title}} </a>
												<span style="float:right; color:{{$color2}}"> {{$problem->level}} </span>
											</td>
											<td class="text-center">
												<a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/AC/'.$problem->id) }}" style="color:{{$color}}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{sizeof($problem->accepted)}}</a>
											</td>
											<td class="text-center">
												<a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/WA/'.$problem->id) }}" style="color:{{$color}}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{sizeof($problem->tried)}}</a>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
			@endif

			<div class="card rounded shadow  callout-bordered callout-warning">
				<div class="card-header">
					Selected problems From all problems
				</div>
				<div class="card-body">
					<table class="table table-striped table table-hover table-bordered">
						<thead class="bg-dark text-white">
						<tr>
							<th style="width:5%" class="text-center">#</th>
							<th class="text-center">
								PROBLEM TITLE
							</th>
							<th style="width: 9%;" class="text-center">
								<span title="Solved"><a href="#"><i class="fas fa-check solved" style="color:greenyellow"></i></a></span>
							</th>
							<th style="width: 9%;" class="text-center">
								<span title="Tried"><a href="#"><i class="fas fa-warning" style="color:orangered"></i></a></span>
							</th>
							@if (Auth::user()->admin)
								<th style="width: 7%;" class="text-center">
									<span title="Remove User"><a href="#"><i class="fas fa-sticky-note" style="color: aquamarine"></i></a></span>
								</th>
							@endif
						</tr>
						</thead>
						<tbody>

						{{--{{count($problems)}}--}}

						@if(count($selectedProblems) > 0)
							@foreach ($selectedProblems as $selectedProblem)
								@php
									$cls = "";
									$color = "";
									$color2 = "dimgray";
									if($selectedProblem->level == "Assignment") {
										$cls = "bg-success text-white";
										$color = "white";
										$color2 = "yellow";
									}
								@endphp
								<tr class="{{$cls}}">
									<td  class="text-center"> {{$selectedProblem->id}} </t>
									<td>
										<a href="{{ url($session_name.'/'.$course_name.'/problem/show/'.$selectedProblem->id) }}" target="_blank" style="color:{{$color}}"> {{$selectedProblem->title}} </a>
										<span style="float:right; color:{{$color2}}"> {{$selectedProblem->level}} </span>
									</td>
									<td class="text-center">
										<a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/AC/'.$selectedProblem->id) }}" style="color:{{$color}}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{sizeof($selectedProblem->accepted)}}</a>
									</td>
									<td class="text-center">
										<a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/WA/'.$selectedProblem->id) }}"  style="color:{{$color}}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{sizeof($selectedProblem->tried)}}</a>
									</td>
									@if (Auth::user()->admin)	
										<td class="text-center">
												<a href="{{ url($session_name.'/'.$course_name.'/removeproblem/'.$selectedProblem->id) }}"><i class="fas fa-window-close" style="font-size: 16px; color: red"></i></a>
											{{-- <a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/WA/'.$user->id) }}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{count($user->tried()->where('session_id', $session_id))}}</a> --}}
										</td>
									@endif
								</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				</div>
			</div>


        <div class="row justify-content-center mt-4">
            {{$selectedProblems->links()}}
        </div>

    </div>
@endsection

@section('body')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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