@extends('inc.app')


@section('head')
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
@endsection

@section('contant')

		{{-- <div class="container-fluid mt-4 bg-white justify-content-center mb-lg-4" style="width: 98%;"> --}}
            <div class="card rounded shadow mt-3 p-4"  style="font-family: 'Consolas'">
                <table class="table-striped table-hover table-sm table-bordered text-center rounded">
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
                            
                            {{-- {{dd($submission-)}} --}}
                            <tr>
                        
                                @php
                                    // $problem = \App\Problem::find($submission->problem_id);
                                    $problem = App\Problem::find($submission->problem_id);
                                    $author = App\User::find($submission->user_id);
                                    //$author = \App\User::find($submission->author_id);
                                    // dd($author->toArray());
                                @endphp

                                <td><a id="{{$submission->id}}" class="view_data" style="cursor:pointer; color: dodgerblue;">{{$submission->id}}</a></td>
                                <td> {{$submission->created_at}} </td>
                                <td><a href="/profile/{{$author->id}}">{{$author->name}}</a></td>
                                <td><a href="{{ url($course_name.'/problem/show/'.$problem->id) }}"">{{$problem->title}}</a></td>
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
                                <h4 class="modal-title" id="exampleModalLongTitle">Submit <strong>Problem Name goes here's</strong> Soulution</h4>
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

