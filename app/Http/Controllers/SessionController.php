<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Session;
use Illuminate\Http\Request;
use App\SessionUser;
use App\SessionProblem;
use App\User;
use function GuzzleHttp\json_decode;

class SessionController extends Controller
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
    public function index()
    {
        $sessions = Session::orderBy('id', 'desc')->get();
        $user = Auth::user();
        $user_id = $user->id;

        return view('session.home', compact('sessions', 'user_id'));
    }
    public function indexmy()
    {
        $sessions = Session::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->get();
        $user = Auth::user();
        $user_id = $user->id;
        $sessions = User::find($user_id)->sessions;
         //return $sessions;
        return view('session.home', compact('sessions', 'user_id'));
    }
    public function security($session_name, $course_name, $hashcode ) 
    {
        $session = Session::where('name', $session_name)->first();
        if( $hashcode == $session->hash_code ) {

            // if( DB::table('session_user')->where('user_id', Auth::user()->id)->where('session_id', $session->id) === null ) {
            SessionUser::firstOrCreate(['session_id' => $session->id, 'user_id' => Auth::user()->id], ['session_id' => $session->id, 'user_id' => Auth::user()->id]);

            return view('session.security')->with('me', 'text');
        
            return redirect()->route('sessionProblemset', ['session_name'=>$session_name, 'course_name'=>$course_name]);
        } 
        abort(404);
    }

    public function sessionmembers($session_name, $course_name)
    {

        $session = Session::where('name', $session_name)->first();
        $session_id = $session->id;
        $users = $session->users()->paginate(15);


        return view('session.members', compact('users', 'course_name', 'session_name', 'session_id'));
    }
    public function removeuser($session_name, $course_name, $id)
    {

        $session = Session::where('name', $session_name)->first();
        $session_id = $session->id;
        $session_user = SessionUser::where('session_id', $session_id)->where('user_id', $id)->first();
        
        $session_user->delete();
        return redirect()->back();
    }
    public function removeproblem($session_name, $course_name, $id)
    {

        $session = Session::where('name', $session_name)->first();
        $session_id = $session->id;
        $session_problem = SessionProblem::where('session_id', $session_id)->where('problem_id', $id)->first();
        
        $session_problem->delete();
        $users = $session->users()->paginate(15);

        return redirect()->back();
    }
    public function sessionstandings($session_name, $course_name)
    {

        $session = Session::where('name', $session_name)->first();
        $session_id = $session->id;
        $users = $session->users;
        $problems = $session->problems;
        $arr_ac = array();
        $arr_problem = array();
        $code_link = array();
        $cnt = 0;
        $arr_users = array();

        foreach ($problems as $problem ) {
            $arr_ac[$problem->id] = array();
            $code_link[$problem->id] = array();
            $accepteds = $problem->accepted()->where('session_id', $session_id)->get();

            foreach ($accepteds as $accepted) {
                $user_id = $accepted->user_id;
                $arr_ac[$problem->id][$user_id] = 1;
                $code_link[$problem->id][$user_id] = $accepted;
            }
            $cnt++;
        }
        foreach ($users as $user) {

            foreach ($problems as $problem) {
                if( isset($arr_ac[$problem->id][$user->id]) ) {
                    if (!isset($arr_users[$user->id])) {
                        $arr_users[$user->id] = 0;
                    } 
                    $arr_users[$user->id] += 1;
                }
            }
        }
        arsort($arr_users);
        // return $code_link;
        return view('session.standings', compact('users', 'course_name', 'session_name', 'session_id', 'problems', 'arr_ac', 'code_link', 'cnt', 'arr_users'));
    }
    public function sessioncompiler($session_name, $course_name)
    {
        return view('session.compiler', compact('course_name', 'session_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('session.create');
    }

/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
         //dd($request->toArray());
        $created = Session::create([
            'name' => $request->season.$request->year.'-'.$request->batch.'-'.$request->section,
            'course_id' => $request->course,
            'user_id' => Auth::user()->id,
            'batch' => $request->batch,
            'section' => $request->section,
            'hash_code' => $request->security
        ]);
        if( $created ) {
            $session_user = new SessionUser();
            $session_user->session_id = $created->id;
            $session_user->user_id = Auth::user()->id;
            $session_user->save();

            // SessionUser::updateOrCreate(
            //     'session_id' => $created->id,
            //     'user_id' => Auth::user()->id
            // );
            // DB::table('session_user')->insert([
                
            // ]);
            return redirect('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
