<?php

namespace App\Http\Controllers;

use App\Submission;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Jobs\CompileCode;
use Illuminate\Support\Carbon;
use App\Session;
use function GuzzleHttp\json_encode;
use App\Problem;
use App\Accepted;
use App\Tried;

class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $session_name, $course_name)
    {

        $session = Session::where('name', $session_name)->first();
        $session_id = $session->id;
        $submissions = Submission::orderBy('id', 'desc')->where('session_id', $session_id)->paginate(10);
        
        return view('submission.home', compact('submissions', 'course_name', 'session_name'));
    }
    public function all()
    {   
        $submissions = Submission::orderBy('id', 'desc')->paginate(100);
        return view('submission.all', compact('submissions'));
    }
    public function acm_status()
    {

        $submissions = Submission::orderBy('id', 'desc')->where('acm', 1)->paginate(10);
        
        return view('acm.status', compact('submissions'));
    }
    public function rejudge()
    {
        $submissions = DB::table('submissions')->where('result', 'queued')->get();
        foreach ($submissions as $submission) {
            dispatch(new CompileCode($submission->problem_id, $submission->id, $submission->session_id));
        }
        
        return $submissions;
    }
    public function rejudgesession(Request $request)
    {
        $link = $request->sessionlink;
        $link = explode('/', $link);
        $session_name = $link[0];
        $session = Session::where('name', $session_name)->first();
        if($session == null) {
            abort(404);
            return;
        }
        $session_id = $session->id;
        $submissions = Submission::where('session_id', $session_id)->get();

        $cnt = 0;
        foreach ($submissions as $submission) {
            // if($submission->result == "queued" || $submission->result == "Judging...") {
            if($submission->result == "Accepted") {
                $verdicts = Accepted::where('submission_id', $submission->id)->get();
                foreach ($verdicts as $verdict) {
                    $verdict->delete();
                }
            } else if($submission->result != "queued" && $submission->result != "Judging..."){
                $verdicts = Tried::where('submission_id', $submission->id)->get();
                foreach ($verdicts as $verdict) {
                    $verdict->delete();
                }
            }

            $submission->result = "queued";
            $submission->save();
            dispatch(new CompileCode($submission->problem_id, $submission->id, $submission->session_id));

        }
        
        return redirect()->back();
    }
    public function rejudgeproblem(Request $request)
    {
        $problem = Problem::find($request->problemid);

        if( $problem == null ) {
            abort(404);
            return;
        }
        $submissions = $problem->submissions;

        foreach ($submissions as $submission) {
            // if($submission->result == "queued" || $submission->result == "Judging...") {
                if($submission->result == "Accepted") {
                    $verdicts = Accepted::where('submission_id', $submission->id)->get();
                    foreach ($verdicts as $verdict) {
                        $verdict->delete();
                        # code...
                    }
                    // print($cnt++);   
                    // return $submission->id;
                } else if($submission->result != "queued" && $submission->result != "Judging..."){
                    $verdicts = Tried::where('submission_id', $submission->id)->get();
                // print($cnt++);
                    foreach ($verdicts as $verdict) {
                        $verdict->delete();
                        # code...
                    }
                }

                $submission->result = "queued";
                $submission->save();
                dispatch(new CompileCode($submission->problem_id, $submission->id, $submission->session_id));

            // }
        }
        
        
        return redirect()->back();
    }
    public function rejudgesubmission(Request $request)
    {
        $sub = Submission::find($request->submissionid);

        if( $sub == null ) {
            abort(404);
            return;
        }
        // return $sub;
        $submission = $sub;

        // foreach ($submissions as $submission) {
            // if($submission->result == "queued" || $submission->result == "Judging...") {
                if($submission->result == "Accepted") {
                    $verdicts = Accepted::where('submission_id', $submission->id)->get();
                    foreach ($verdicts as $verdict) {
                        $verdict->delete();
                        # code...
                    }
                    // print($cnt++);   
                    // return $submission->id;
                } else if($submission->result != "queued" && $submission->result != "Judging..."){
                    $verdicts = Tried::where('submission_id', $submission->id)->get();
                // print($cnt++);
                    foreach ($verdicts as $verdict) {
                        $verdict->delete();
                        # code...
                    }
                }

                $submission->result = "queued";
                $submission->save();
                dispatch(new CompileCode($submission->problem_id, $submission->id, $submission->session_id));

            // }
        // }
        
        
        return redirect()->back();
    }
    public function rejudgeuser(Request $request)
    {
        $user = User::find($request->userid);
        if($user == null ) {
            abort(404);
            return ;
        }
        $submissions = $user->submissions;

        foreach ($submissions as $submission) {
            // if($submission->result == "queued" || $submission->result == "Judging...") {
                if($submission->result == "Accepted") {
                    $verdicts = Accepted::where('submission_id', $submission->id)->get();
                    foreach ($verdicts as $verdict) {
                        $verdict->delete();
                        # code...
                    }
                    // print($cnt++);   
                    // return $submission->id;
                } else if($submission->result != "queued" && $submission->result != "Judging..."){
                    $verdicts = Tried::where('submission_id', $submission->id)->get();
                // print($cnt++);
                    foreach ($verdicts as $verdict) {
                        $verdict->delete();
                        # code...
                    }
                }

                $submission->result = "queued";
                $submission->save();
                dispatch(new CompileCode($submission->problem_id, $submission->id, $submission->session_id));

            // }
        }
        
        
        return redirect()->back();
    }
    public function rejudgeall(Request $request)
    {
        $submissions = Submission::all();
        foreach ($submissions as $submission) {
            // if($submission->result == "queued" || $submission->result == "Judging...") {
                if($submission->result == "Accepted") {
                    $verdicts = Accepted::where('submission_id', $submission->id)->get();
                    foreach ($verdicts as $verdict) {
                        $verdict->delete();
                        # code...
                    }
                    // print($cnt++);   
                    // return $submission->id;
                } else if($submission->result != "queued" && $submission->result != "Judging..."){
                    $verdicts = Tried::where('submission_id', $submission->id)->get();
                // print($cnt++);
                    foreach ($verdicts as $verdict) {
                        $verdict->delete();
                        # code...
                    }
                }

                $submission->result = "queued";
                $submission->save();
                dispatch(new CompileCode($submission->problem_id, $submission->id, $submission->session_id));

            // }
        }
        
        
        return redirect()->back();
    }

    public function sessionmysubmission( $session_name, $course_name )
    {
        
        $session = Session::where('name', $session_name)->first();
        $session_id = $session->id;
        $submissions = $session->submissions()->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
        
        return view('submission.sessionmysubmission', compact('submissions', 'course_name', 'session_name'));
    }

    public function load()
    {
        return view('submission.loadcontant');
    }
    public function rejudgepage()
    {
        return view('submission.rejudge');
    }

    public function runcode()
    {

        //return view('submission.run');
         return view('submission.runGeekforGeeks');
        
    }
    public function mysubmissions()
    {
        $user = User::find(Auth::user()->id);
        $submissions = $user->submissions()->orderBy('id', 'desc')->paginate(15); 
        return view('submission.mysubmission', compact('submissions'));
    }
    public function acm_mysubmissions()
    {
        $user = User::find(Auth::user()->id);
        $submissions = $user->submissions()->orderBy('id', 'desc')->where('acm', 1)->paginate(15); 
        return view('acm.mysubmissions', compact('submissions'));
    }
    public function contests()
    {

        $url = "https://clist.by/api/v1/json/contest/?start__gte=2019-04-04T09%3A29%3A45&order_by=start&limit=100&offset=50";
        $auth = "&username=roy&api_key=9e9446302b87aca495da32643765aae87fe622a4";

        $url .= $auth;

        $contestData = file_get_contents($url);

        $decoded_data = json_decode($contestData);
        $decoded_data = $decoded_data->objects;

        $ind = 0;
        foreach ($decoded_data as $data) {
            $id = $data->resource->id;
            if( $id == 1 || $id == 2 ||  $id == 12 || $id == 73 || $id == 35 ) {

                $data->start = str_replace("T", " | ", $data->start);
                $data->end = str_replace("T", " | ", $data->end);
                $decoded_data[$ind] = $data;
            } else {
                unset($decoded_data[$ind]);
            }
            $ind++;
        }

        return view('api.contests', compact('decoded_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submission $submission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submission $submission)
    {
        //
    }
}
