@extends('inc.app')


@section('head')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection

@section('contant')
    <div class="container-fluid mt-4">
        <div style="float:right">
        </div>

        <div class="row">
            <div class="col">
                <div class="card rounded shadow">
                    <div class="card-header">
                        First solve the problem then write the code
                        <a href="{{url($session_name.'/'.$course_name.'/problem/create')}}" class="btn btn-primary" style="float:right">Create New Problem</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url($session_name.'/'.$course_name.'/problem/addexistingproblem')}}" method="post">
                            @csrf
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

                                @if(count($problemsFromCourse) > 0)
                                    @foreach ($problemsFromCourse as $problem)
                                        <tr>
                                            <td> <input type="checkbox" name="check_list[]" value={{$problem->id}}></td>
                                            <td>
                                                <a href="{{ url($session_name.'/'.$course_name.'/problem/show/'.$problem->id) }}"> {{$problem->title}} </a>
                                                <span style="float:right; color:dimgray">beginner</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/AC/'.$problem->id) }}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{sizeof($problem->accepted)}}</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url($session_name.'/'.$course_name.'/problem/submissions/WA/'.$problem->id) }}"><i class="fas fa-user" style="font-size: 16px;"></i> x{{sizeof($problem->tried)}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                            @if(count($problemsFromCourse) > 0)
                                <input class="btn btn-primary" type="submit" name="submit" value="Add"/>
                            @endif
                        </form>
                    </div>
                </div>
                {{--<form action="{{url($session_name.'/problems')}}" method="post">--}}
                    {{--@csrf--}}
                    {{--@foreach($problemsFromCourse as $problemCourse)--}}
                        {{--<input type="checkbox" name="check_list[]" value={{$problemCourse->id}}><label>{{$problemCourse->title}}</label><br/>--}}
                    {{--@endforeach--}}
                    {{--<input type="submit" name="submit" value="Submit"/>--}}
                {{--</form>--}}
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            {{$problemsFromCourse->links()}}
        </div>

    </div>
@endsection
