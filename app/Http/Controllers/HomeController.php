<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Problem;
use App\InputOutput;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function about()
    {
        return view('about');
    }
    
    public function profile($id)
    {
        $user = User::find($id);
        $submissions = User::find($id) ->submissions()->orderBy('id', 'desc')->paginate(35);
        return view('profile.profile', compact('submissions', 'user'));
    }
    public function problem($id)
    {
        $problem = Problem::find($id);
        $input_outputs = InputOutput::where('problem_id', $id)->get();
        return view('profile.problem', compact('problem', 'input_outputs'));
    }
    public function add_data()
    {
        return view('add_data');
    }
    public function addinputoutput(Request $request)
    {
        $link = $request->link;

        $link = explode('/', $link);
        $problem_id = end($link);

        $created = InputOutput::create([
            'problem_id' => $problem_id,
            'input' => $request->input,
            'output' => $request->output,
            'sample' => 0,
        ]);
        return view('add_data');
    }
    public function makeadmin(Request $request)
    {

        
        $user = User::find($request->userid);
        if($user == null) {
            abort(404);
        }
        $user->admin = 1;
        $user->save();
        
        return view('add_data');
    }
}
