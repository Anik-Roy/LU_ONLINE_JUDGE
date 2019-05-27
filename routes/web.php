<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/mylogin', function () {
    return view('auth.mylogin');
});

Route::get('/mysignup', function () {
    return view('auth.mysignup');
});

Route::get('/test', function () {
    return view('coreui');
});
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/myprofile', 'HomeController@profile');
Route::get('/profile/{id}', 'HomeController@profile');
Route::get('/about', 'HomeController@about');
Route::get('/problem/{id}', 'HomeController@problem');

Route::get('/add-data', 'HomeController@add_data');
Route::post( '/addinputoutput', 'HomeController@addinputoutput');
Route::post( '/makeadmin', 'HomeController@makeadmin');


Auth::routes();

Route::get('/home', 'SessionController@index');
Route::get('/home/my', 'SessionController@indexmy');
Route::get('/session/create', 'SessionController@create');
Route::post('/session/save', 'SessionController@save');

Route::get('/create', 'PostController@create');
Route::get('/show/{id}', 'PostController@show');
Route::get('/posts', 'PostController@index');
Route::get('/edit/{id}', 'PostController@edit');
Route::post('/update/{id}', 'PostController@update');
Route::post('/save', 'PostController@save');
Route::get('/delete/{id}', 'PostController@destroy');

Route::get('/submissions', 'SubmissionController@all');

Route::get('/{session_name}/{course_name}/security/{hashcode}', 'SessionController@security');
Route::get('/{session_name}/{course_name}/session-members', 'SessionController@sessionmembers')->name('sessionMembers');
Route::get('/{session_name}/{course_name}/custom-test', 'SessionController@sessioncompiler')->name('sessionCompiler');
Route::get('/{session_name}/{course_name}/remove/{id}', 'SessionController@removeuser');
Route::get('/{session_name}/{course_name}/removeproblem/{id}', 'SessionController@removeproblem');
Route::get('/{session_name}/{course_name}/standings', 'SessionController@sessionstandings')->name('sessionStandings');
Route::get('{session_name}/{course_name}/problemset', 'ProblemController@index')->name('sessionProblemset');
Route::get( '{session_name}/{course_name}/submissions', 'SubmissionController@index')->name('sessionSubmissions');
Route::get( '{session_name}/{course_name}/sessionmysubmission', 'SubmissionController@sessionmysubmission')->name( 'sessionMySubmissions');
Route::get('{session_name}/{course_name}/selectproblem', 'ProblemController@selectproblem');
Route::get('{session_name}/{course_name}/problem/show/{id}', 'ProblemController@show');
Route::get('{session_name}/{course_name}/problem/create', 'ProblemController@create');
Route::post('{session_name}/{course_name}/problem/addexistingproblem', 'ProblemController@addexistingproblem');
Route::get('{session_name}/{course_name}/problem/addproblem', 'ProblemController@addproblem');
Route::post('{session_name}/{course_name}/problem/save', 'ProblemController@save');
Route::get('/showproblem/{id}', 'ProblemController@showproblem');
Route::get('/compiler', 'ProblemController@compiler');
Route::post('/compile', 'ProblemController@compile');
Route::get('{session_name}/{course_name}/problem/submissions/AC/{id}', 'ProblemController@acproblemSubmissions');
Route::get('{session_name}/{course_name}/problem/submissions/WA/{id}', 'ProblemController@waproblemSubmissions');
Route::post('{session_name}/{course_name}/submit/{id}', 'ProblemController@submit');

Route::get('/mysubmissions', 'SubmissionController@mysubmissions');
Route::get('/loadcontant', 'SubmissionController@load');
Route::get('/runcode', 'SubmissionController@runcode');
Route::post('/runcode', 'SubmissionController@geekForGeeks');

Route::get('/contests', 'SubmissionController@contests');

Route::get('/rejudgepage', 'SubmissionController@rejudgepage');

Route::get('/rejudge', 'SubmissionController@rejudge');
Route::post('/rejudgesession', 'SubmissionController@rejudgesession');
Route::post('/rejudgeproblem', 'SubmissionController@rejudgeproblem');
Route::post('/rejudgesubmission', 'SubmissionController@rejudgesubmission');
Route::post('/rejudgeuser', 'SubmissionController@rejudgeuser');
Route::post('/rejudgeall', 'SubmissionController@rejudgeall');

//ACM
Route::get('/ACM/problemset', 'ProblemController@acm_problems');
Route::get('/ACM/create', 'ProblemController@acm_create');
Route::post('/ACM/problem/save', 'ProblemController@acm_save');
Route::post('/ACM/submit/{id}', 'ProblemController@acm_submit');
Route::get('/ACM/status', 'SubmissionController@acm_status');
Route::get('/ACM/compiler', 'ProblemController@acm_compiler');
Route::get('/ACM/mysubmissions', 'SubmissionController@acm_mysubmissions');
Route::get('/ACM/standings', 'ProblemController@acm_standings');
Route::get('/ACM/problem/show/{id}', 'ProblemController@acm_problem_show');


//Blog Route
Route::get('/blog/{id}', 'BlogController@index');
Route::post('/blog/store', 'BlogController@store');
Route::post('/blog/create', 'BlogController@createCategory');
Route::get('/editpost/{id}', 'BlogController@editpost');
Route::post('post/edit/{id}', 'BlogController@edit');
Route::get('/deletepost/{id}', 'BlogController@deletePost');
Route::post('post/delete/{id}', 'BlogController@destroy');
Route::get('/deletecategory/{id}', 'BlogController@deleteCategory')->name('dCategory');
Route::get('/liveblogpost/{id}', 'BlogController@liveBlogPostById');
Route::get('liveblogpost', 'BlogController@liveBlogPost');

//Comment Controller
Route::post('/blog/comment/store/{id}', 'CommentController@store')->name('commentstore');
Route::post('/blog/comment/poststore/{id}', 'CommentController@poststore')->name('Postcommentstore');