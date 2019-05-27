@extends('inc.app')
@section('contant')
    <div class="container">
        <legend>Create new post</legend>

        <div class="card">
            <div class="card-body">
                <form method="post" action="{{url('/update/'.$post->id)}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="my-input">Text</label>
                    <input  name="title" class="form-control" type="text" value="{{$post->title}}" required>
                    </div>
                    <div class="form-group">
                        <label for="input">Body</label>
                        <textarea  name="body" class="form-control" rows="3" required>{{$post->body}}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success float-right" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
