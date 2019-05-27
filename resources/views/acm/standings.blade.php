@extends('inc.app')


@section('head')
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" media="screen" href="/css/dulon.css">
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
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
					<div class="projects-item border-left border-right ml-2">
						<a href="/ACM/mysubmissions" class="menu_item">My Submissions</a>
						<div class="overlay"></div>
					</div>
				</li>
				<li id="bg-efect">
					<div class="menu_active border-left border-right ml-2">
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
        <div class="card rounded shadow  callout-bordered callout-warning">
				<div class="card-header">
					Standings based on problem solved
				</div>
				<div class="card-body">
					<table class="table table-striped table table-hover table-bordered">
						<thead class="bg-dark text-white">
						<tr>
							<th style="width:5%" class="text-center">#</th>
							<th class="text-center">
								Name
							</th>
							<th style="width: 9%;" class="text-center">
								<span title="Solved"><a href="#"><i class="fas fa-check solved" style="color:greenyellow"></i></a></span>
							</th>
						</tr>
						</thead>
						<tbody>

						{{--{{count($problems)}}--}}
                        @php
                            $cnt = 1;
                        @endphp
						@if(count($users) > 0)
							@foreach ($users as $user)
								<tr>
									<td class="text-center"> {{$cnt++}} </td>
									<td>
                                        <a href="" target="_blank"> {{$user->name}}</a>
                                        <span style="color:darkgray;"!important>  ({{$user->id}})</span>
									</td>
									<td class="text-center">
										<a href="">{{$user->solved}}</a>
									</td>

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