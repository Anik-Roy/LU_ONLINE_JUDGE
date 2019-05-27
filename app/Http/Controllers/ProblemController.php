<?php

namespace App\Http\Controllers;

use App\InputOutput;
use App\Problem;
use App\User;
use App\Submission;
use Auth;
use Illuminate\Http\Request;
use App\Jobs\CompileCode;
use App\Course;
use App\Session;
use function GuzzleHttp\json_encode;
use App\SessionProblem;

class ProblemController extends Controller
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
    public function index($session_name, $course_name)
    {

        $session = Session::where('name', $session_name)->first();
        $session_id = $session->id;

        $problems = Problem::where('session_id', $session_id)->paginate(15);
        $problemsFromCourse = Problem::paginate(15);

        $links = $problems->links();

        $selectedProblems = Session::find($session_id)->problems()->paginate(15);
        $selectedLinks = $problems->links();

        if (count($problems) > 0 || count($selectedProblems) > 0)
            return view('problem.problemset', compact('problems', 'links', 'selectedProblems', 'selectedLinks', 'course_name', 'session_name'));

        else {
            $links = $problemsFromCourse->links();
            return view('problem.selectproblem', compact('problemsFromCourse', 'links', 'course_name', 'session_name'));
        }
    }

    public function selectproblem($session_name, $course_name)
    {
        $session = Session::where('name', $session_name)->first();
        $session_id = $session->id;
        $problemsFromCourse = Problem::paginate(15);
        $links = $problemsFromCourse->links();
        return view('problem.selectproblem', compact('problemsFromCourse', 'links', 'course_name', 'session_name'));
    }

    public function acproblemSubmissions($session_name, $course_name, $id)
    {
 
        // $solutions = Problem::find($id)->accepted;

        $session_id = Session::where('name', $session_name)->first();
        $session_id = $session_id->id;
        
        $submissions = \DB::table('submissions')
        ->join('accepteds','accepteds.submission_id','=','submissions.id')
        ->select('submissions.*')
        ->orderBy('submissions.created_at', 'desc')
        ->where('submissions.session_id', '=', $session_id)
        ->where('submissions.problem_id', '=', $id)
        ->paginate(35);

        return view('problem.submission', compact('submissions', 'course_name', 'session_name'));
        
    }

    public function waProblemSubmissions($session_name, $course_name, $id)
    {
        // $solutions = Problem::find($id)->tried;

        $session_id = Session::where('name', $session_name)->first();
        $session_id = $session_id->id;
        $submissions = \DB::table('submissions')
        ->join('trieds', 'trieds.submission_id', '=', 'submissions.id')
        ->select('submissions.*')
        ->where('submissions.session_id', '=', $session_id)
        ->where('submissions.problem_id', '=', $id)
        ->orderBy('submissions.created_at', 'desc')
        ->paginate(35);
        
        return view('problem.submission', compact('submissions', 'course_name', 'session_name'));
        
    }
    public function addexistingproblem(Request $request, $session_name, $course_name)
    {
        $problems = $request->check_list;

        $session_id = Session::where('name', $session_name)->first();
        $session_id = $session_id->id;

        foreach ($problems as $id) {
            //            $created = SessionProblem::create([
            //                'session_id'=>$session_id,
            //                'problem_id'=>$id
            //            ]);

            SessionProblem::firstOrCreate(['session_id' => $session_id, 'problem_id' => $id], ['session_id' => $session_id, 'problem_id' => $id]);
        }
        return redirect($session_name . '/' . $course_name . '/problemset')->with('message', 'Problem is added successfully');
        //return $problems;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($session_name, $course_name)
    {
        return view('problem.create', compact('course_name', 'session_name'));
    }

    public function compiler()
    {
        return view('problem.compiler');
    }

    public function compile(Request $request)
    {

        $lang = $request->language;
        $code = $request->code;
        $input = $request->input;

        return view('problem.run', compact('lang', 'code', 'input'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $session_name, $course_name)
    {

        $course_id = Course::where('name', $course_name)->first();
        $course_id = $course_id->id;
        $session_id = Session::where('name', $session_name)->first();
        $session_id = $session_id->id;

        // return $request;

        $created = Problem::create([
            'title' => $request->title,
            'course_id' => $course_id,
            'author_id' => Auth::user()->id,
            'session_id' => $session_id,
            'time_limit' => $request->timelimit,
            'memory_limit' => $request->memorylimit,
            'body' => $request->description,
            'level' => $request->level,
            'input_sec' => $request->input_sec,
            'output_sec' => $request->output_sec,
        ]);
        if ($created) {

            $created = InputOutput::create([
                'problem_id' => $created->id,
                'input' => $request->input,
                'output' => $request->output,
                'sample' => 1,
            ]);

            return redirect($session_name.'/'.$course_name.'/problemset')->with('message', 'Problem is added successfully');
        }
    }


    public function show($session_name, $course_name, $id)
    {   
        $problem = Problem::find($id);
        $input_outputs = InputOutput::where('problem_id', $id)->where('sample', 1)->get();

        return view('problem.show', compact('problem', 'course_name', 'session_name', 'input_outputs'));
    }
    public function showproblem($id)
    {   
        $problem = Problem::find($id);

        return view('problem.showproblem', compact('problem'));
    }


    public function submit(Request $request, $session_name, $course_name, $id)
    {
        //dd($request->toArray());
        $session_id = Session::where('name', $session_name)->first();
        $session_id = $session_id->id;
        $created = Submission::create([
            'problem_id' => $id,
            'user_id' =>  Auth::user()->id,
            'session_id' => $session_id,
            'code' => $request->code,
            'language' => $request->language
            ]);
        
        if( $created ) {
            //echo "$created";
            dispatch( new CompileCode($id, $created->id, $session_id));
            // dispatch( new CompileCode($id, $created->id))->delay(now()->addSeconds(10));
            return redirect( $session_name.'/'.$course_name. '/submissions')->with('message', 'Your problem is submitted successfully');
        }
        
    }
    public function acm_problems()
    {
        $problems = Problem::where('acm', '1')->paginate(15);
        // return $problems;
        return view('acm.problemset', compact('problems'));
    }
    public function acm_create()
    {
        return view('acm.create');
    }
    public function acm_save(Request $request)
    {
        $created = Problem::create([
            'title' => $request->title,
            'course_id' => 0, // For ACM no Course ID required
            'author_id' => Auth::user()->id,
            'session_id' => 0, // For ACM no Session ID required
            'time_limit' => $request->timelimit,
            'memory_limit' => $request->memorylimit,
            'body' => $request->description,
            'acm' => 1, // New Column data for ACM
            'level' => $request->level,
            'input_sec' => $request->input_sec,
            'output_sec' => $request->output_sec,
        ]);
        if ($created) {

            $created = InputOutput::create([
                'problem_id' => $created->id,
                'input' => $request->input,
                'output' => $request->output,
            ]);

            return redirect('/ACM/problemset')->with('message', 'Problem is added successfully');
        }
        abort(404);
    }

    public function acm_submit(Request $request, $id)
    {
        $created = Submission::create([
            'problem_id' => $id,
            'user_id' =>  Auth::user()->id,
            'session_id' => 0, // No session ID 
            'acm' => 1,
            'code' => $request->code,
            'language' => $request->language
        ]);

        if ($created) {
            //echo "$created";
            dispatch(new CompileCode($id, $created->id, 0));
            // dispatch( new CompileCode($id, $created->id))->delay(now()->addSeconds(10));
            return redirect('ACM/status')->with('message', 'Your problem is submitted successfully');
        }
    }

    public function acm_compiler()
    {
        return view('acm.compiler');
    }
    public function acm_problem_show($id)
    {
        $problem = Problem::find($id);
        return view('acm.show', compact('problem'));
    }
    public function acm_standings()
    {
        $users = User::orderBy('solved', 'desc')->paginate(15);
        return view('acm.standings', compact('users'));
    }
    
}
