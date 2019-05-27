@extends('inc.app')


@section('contant')

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
                            <th>VERDICT</th>
                            <th>MEMORY</th>
                            <th>CPU</th>
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
                                    $vd = "";
                                    if(Auth::user()->id == $author->id) {
                                        $vd = "view_data";
                                    }
                                @endphp

                                <td style=" width: 5%;"><a id="{{$submission->id}}" class="{{$vd}}" style="cursor:pointer; color: dodgerblue;">{{$submission->id}}</a></td>
                                <td> {{$submission->created_at}} </td>
                                <td><a href="/profile/{{$author->id}}">{{$author->name}}</a></td>
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

            $(' #bg-efect > .projects-item ').each(function () {
                $(this).hoverdir();
            });

        });
    </script>
@endsection

@section('head')
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
  <link rel="stylesheet" type="text/css" media="screen" href="/css/dulon.css">
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
