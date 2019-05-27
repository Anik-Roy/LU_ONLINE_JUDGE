@extends('inc.app')


@section('head')
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" media="screen" href="/css/dulon.css">
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
					<div class="menu_active border-left ml-2">
						<a href=""{{ route('sessionMembers', ['session_name'=>$session_name, 'course_name'=>$course_name]) }}" class="menu_item">Enrolled Users</a>
						<div class="overlay"></div>
					</div>
				</li>
			</ul>
		</div>
	</div>


    <div class="container-fluid mt-4">
			<div class="card rounded shadow  callout-bordered callout-info">
				<div class="card-header">
					Members, who enolled this session
				</div>
				<div class="card-body">
					<table class="table table-striped table table-hover table-bordered">
						<thead class="bg-dark text-white">
							<tr>
								<th style="width:5%" class="text-center">#</th>
								<th class="text-center">
									User Name
								</th>
								<th style="width: 9%;" class="text-center">
									<span title="Solved"><a href="#"><i class="fas fa-check solved" style="color:greenyellow"></i></a></span>
								</th>
								<th style="width: 9%;" class="text-center">
									<span title="Tried"><a href="#"><i class="fas fa-warning" style="color: orangered"></i></a></span>
								</th>
								@if (Auth::user()->admin)
									<th style="width: 7%;" class="text-center">
										<span title="Remove User"><a href="#"><i class="fas fa-user" style="color:aqua"></i></a></span>
									</th>
								@endif
							</tr>
						</thead>
						<tbody>

							{{--{{count($problems)}}--}}

							@if(count($users) > 0)
								@foreach ($users as $user)
									<tr>
										<td> {{$user->id}} </td>
										<td>
											<a href="/profile"> {{$user->name}} </a>
										</td>
										<td class="text-center disabled">
											<a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/AC/'.$user->id) }}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{count($user->accepteds)}}</a>
											{{-- <a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/AC/'.$user->id) }}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{count($user->accepted()->where('session_id', $session_id))}}</a> --}}
										</td>
										<td class="text-center disabled">
											<a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/WA/'.$user->id) }}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{count($user->trieds)}}</a>
											{{-- <a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/WA/'.$user->id) }}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{count($user->tried()->where('session_id', $session_id))}}</a> --}}
										</td>
										@if (Auth::user()->admin)
											<td class="text-center disabled">
												<a href="{{ url($session_name.'/'.$course_name.'/remove/'.$user->id) }}"><i class="fas fa-window-close" style="font-size: 16px; color: red"></i></a>
												{{-- <a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/WA/'.$user->id) }}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{count($user->tried()->where('session_id', $session_id))}}</a> --}}
											</td>
										@endif
										
									</tr>
								@endforeach
                                <div class="row justify-content-center mt-4">
                                    {{$users->links()}}
                                </div>
							@endif
						</tbody>
					</table>
				</div>
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