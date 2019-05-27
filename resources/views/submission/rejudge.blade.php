
@extends('inc.app')
@section('contant')

    <div class="container mt-2">

        <div class="card">
            <div class="card-header">
                <h4>Rejudge of Session Submissions</h4>
            </div>
            <div class="card-body">
                <form method="post" action="/rejudgesession">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">https://lucodelab.com/</span>
                                </div>
                                <input name="sessionlink" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="{ Session Dashboard }">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Go</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Rejudge of Problem Submissions</h4>
            </div>
            <div class="card-body">
                <form method="post" action="/rejudgeproblem">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">https://lucodelab.com/problem/</span>
                                </div>
                                <input name="problemid" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3"  placeholder="{ Problem ID }">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Go</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Rejudge of Specific Submission</h4>
            </div>
            <div class="card-body">
                <form method="post" action="/rejudgesubmission">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">https://lucodelab.com/submission/</span>
                                </div>
                                <input name="submissionid" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3"  placeholder="{ Submission ID }">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Go</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Rejudge of User's Submissions</h4>
            </div>
            <div class="card-body">
                <form method="post" action="/rejudgeuser">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">https://lucodelab.com/profile/</span>
                                </div>
                                <input name="userid" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3"  placeholder="{ User ID }">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Go</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Rejudge of All Submissions</h4>
            </div>
            <div class="card-body">
                <form method="post" action="/rejudgeall">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">https://lucodelab.com/submissions/</span>
                                </div>
                                <input name="all" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Go</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

