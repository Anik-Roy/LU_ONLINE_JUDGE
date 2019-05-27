@extends('inc.app')



@section('contant')

		<div class="container-fluid mt-4 bg-white justify-content-center mb-lg-4" style="width: 98%;">
			<div class="row"" >
				<div class="col-md-3">
					<div class="card rounded shadow mt-5">
						<div class="card-header"></div>
						<div class="place_middle rounded-circle">
							<img src="/img/user_image.png" style="width: 100%">
						</div>
						<div class="card-body mt-5">
							<div id="handle" class="text-center font-weight-bold"> {{$user->name}} </div>
							<div id="information" class="mt-2">
								<table class="table table-hover table-inverse table-striped table-sm">
									<tr>
										<td class="font-weight-bold">Country:</td>
										<td>BD</td>
									</tr>
									<tr>
										<td class="font-weight-bold">University:</td>
										<td>LU</td>
									</tr>
									<tr>
										<td class="font-weight-bold">Since:</td>
										<td>{{$user->created_at->diffForHumans()}}</td>
									</tr>
									<tr>
										<td class="font-weight-bold">Solved:</td>
										<td> {{$user->solved}} </td>
									</tr>
									<tr>
										<td class="font-weight-bold">Tried:</td>
										<td> {{count($user->trieds)}} </td>
									</tr>
									<tr>
										<td class="font-weight-bold">Accepted:</td>
										<td> {{count($user->accepteds)}} </td>
									</tr>
									<tr>
										<td class="font-weight-bold">Submissions:</td>
										<td>{{ sizeof($submissions) }}</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-9 mb-4">
                    <div class="card rounded shadow mt-5"  style="font-family: 'Consolas'" id="viewcode">
                        <table class="table-striped table-hover table-sm table-bordered text-center">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th style="width: 10%;">#</th>
                                    <th>SUBMISSION TIME</th>
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
                                            $problem = $submission->problem;
                                            $author = $submission->user;
                                            $cls = "";
                                            if( $submission->result == "Wrong Answer" ) {
                                                $cls = "bg-red-intense";
                                            } else if( $submission->result == "Accepted" ) {
                                                $cls = "bg-green-jungle";
                                            } else if( $submission->result == "Compilation Error" ) {
                                                $cls = "bg-orange-intense";
                                            } else if( $submission->result == "Runtime Error" ) {
                                                $cls = "bg-cyan-intense";
                                            } else if( $submission->result == "Time Limit Exceeded" ) {
                                                $cls = "bg-blue-intense";
                                            } else if( $submission->result == "Memory Limit Exceeded" ) {
                                                $cls = "bg-orange-intense";
                                            } else {
                                                $cls = "bg-gray";
                                            }
                                        @endphp


                                        <td><a id="{{$submission->id}}" class="view_data" style="cursor:pointer; color: dodgerblue;">{{$submission->id}}</a></td>
                                        <td> {{$submission->created_at}} </td>

                                        <td><a href="/problem/{{$problem->id}}" target="_blank">{{$problem->title}}</a></td>
                                        <td> {{$submission->language}} </td>
                                        <td><a id="{{$submission->id}}" class="view_data" style="cursor:pointer; color: dodgerblue;"><span class="label {{$cls}}">{{$submission->result}}</span></a></td>
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
				</div>
			</div>
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
@section('head')
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
	<style>
        .place_middle {
            background: #fff;
            border: #bbb solid 1px;
            height: 125px;
            left: 0;
            margin: auto;
            position: absolute;
            right: 0;
            top: -45px;
            overflow: hidden;
            width: 125px;
        }
    </style>
    <style>
        .bg-green-jungle {
            background: #26c281!important;
        }
        .bg-red-intense {
            background: #e35b5a!important;
        }
        .bg-cyan-intense {
            background: #00AAAA!important;
        }
        .bg-orange-intense {
            background: #e5af25!important;
        }
        .bg-blue-intense {
            background: #0000FF!important;
        }
        .label {
            text-shadow: none!important;
            font-size: 14px;
            font-weight: 300;
            padding: 3px 6px;
            color: #fff;
            font-family: Open Sans,sans-serif;
        }
        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 83%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25em;
        }
    </style>
@endsection