@extends('inc.app')
@section('contant')

    <div class="container">

        <div class="card text-center font-weight-bolder card-accent-success" >
            <legend>Create new Problem</legend>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="post" action="{{url($session_name.'/'.$course_name.'/problem/save')}}">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <label for="title">Problem Name</label>
                        <input  name="title" class="form-control border border-primary" type="text" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="timelimit">Time Limit</label>
                                <input  name="timelimit" class="form-control border border-primary" type="text" required>
                            </div>
                            <div class="col">
                                <label for="memorylimit">Memory Limit</label>
                                <input  name="memorylimit" class="form-control border border-primary" type="text" required>
                            </div>
                            <div class="col">
                                <label for="level">Category</label>
                                <select name="level" class="form-control border border-primary">
                                    <option value="Beginner">Beginner</option>
                                    <option value="If-Else">If-Else</option>
                                    <option value="Loop">Loop</option>
                                    <option value="Array">Array</option>
                                    <option value="String">String</option>
                                    <option value="Assignment">Assignment</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Problem Description</label>
                        <textarea class="form-control border border-primary" name="description" id="editor" required>
                        </textarea>
                        
                        {{-- <textarea  name="description" class="form-control" rows="10" required></textarea> --}}
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="input_sec">Input Section</label>
                            <textarea  name="input_sec" class="form-control border border-primary" rows="3" required></textarea>
                        </div>
                        <div class="col">
                            <label for="output_sec">Output Section</label>
                            <textarea  name="output_sec" class="form-control border border-primary" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="input">Input</label>
                            <textarea  name="input" class="form-control border border-primary" rows="5"></textarea>
                        </div>
                        <div class="col">
                            <label for="output">Output</label>
                            <textarea  name="output" class="form-control border border-primary" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success float-right mt-3" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('body')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection