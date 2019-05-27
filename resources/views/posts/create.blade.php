
@extends('inc.app')
@section('contant')

    <div class="container mt-5">

        <legend>Create new post</legend>

        <div class="card">
            <div class="card-body">
                <form method="post" action="{{url('/save')}}">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <label for="my-input">Text</label>
                        <input  name="title" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="input">Body</label>
                        <textarea  name="body" class="form-control" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success float-right" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

