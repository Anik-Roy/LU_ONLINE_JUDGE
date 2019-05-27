
@extends('inc.app')
@section('contant')

    <div class="container mt-2">

        <div class="card">
            <div class="card-header">
                <h4>Add Input-Outputs</h4>
            </div>
            <div class="card-body">
                <form method="post" action="/addinputoutput">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <label for="link">Problem Link</label>
                        <input  name="link" class="form-control" type="text" required>
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
                    <div class="form-group mt-3">
                        <button class="btn btn-success float-right" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Add Admin</h4>
            </div>
            <div class="card-body">
                <form method="post" action="/makeadmin">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">https://lucodelab.com/profile/</span>
                                </div>
                                <input name="userid" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

@endsection

