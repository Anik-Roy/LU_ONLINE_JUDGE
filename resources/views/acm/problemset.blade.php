
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
					<div class="projects-item border-left border-right ml-2">
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
        <div class="container-fluid mt-4">
			<div class="card rounded shadow  callout-bordered callout-info">
				<div class="card-header">
					First solve the problem then write the code
					<a href="/ACM/create" class="btn btn-primary" style="float:right;"> Create New Problem </a>
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
									<tr>
										<td class="text-center"> {{$problem->id}} </td>
										<td>
											<a href="/ACM/problem/show/{{$problem->id}}" target="_blank"> {{$problem->title}} </a>
											<span style="float:right; color:dimgray">{{$problem->level}}</span>
										</td>
										<td class="text-center">
											<a href=""><i class="fas fa-user" style="font-size: 16px;"></i> x{{sizeof($problem->accepted)}}</a>
										</td>
										<td class="text-center">
											<a href=""><i class="fas fa-user" style="font-size: 16px;"></i> x{{sizeof($problem->tried)}}</a>
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
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