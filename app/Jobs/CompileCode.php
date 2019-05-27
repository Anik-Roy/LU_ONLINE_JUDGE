<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Submission;
use App\Problem;
use App\Accepted;
use App\User;
use App\Tried;

class CompileCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $problem_id, $submission_id, $session_id;

    public function __construct($problem_id, $submission_id, $session_id)
    {
        $this->submission_id = $submission_id;
        $this->problem_id = $problem_id;
        $this->session_id = $session_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $submission = Submission::find($this->submission_id);
        $problem = Problem::find($this->problem_id);
        $code = $submission->code;
        $tle = $problem->time_limit;
        $mle = $problem->memory_limit;
        $user_id = $submission->user_id;

        $lang = "";
        if( $submission->language == "c" ) {
            $lang = "C";
        } else if( $submission->language == "cpp" ) {
            $lang = "Cpp14";
        } else if( $submission->language == "python" ) {
            $lang = "Python";
        } else if( $submission->language == "java" ) {
            $lang = "Java";
        }

        $mx_tle = -1;
        $mx_mle = -1;
        
        $input_outputs = $problem->inputoutput;

        $submission->result = "Judging...";
        $submission->save();

        $ans = "Accepted";
        
        foreach ($input_outputs as $input_output) {
            $input = $input_output->input;
            $output = $input_output->output;
            $result = $this->GiveMeOutput($code, $input, $tle, $mle, $lang);

            $pattern = '/\s*/m';
            $replace = '';
            $result->output = preg_replace($pattern, $replace, $result->output);
            $output = preg_replace($pattern, $replace, $output);
            if( $result->output == $output && $result->time <= $tle ) {
            // if( $result->output == $output && $result->time <= $tle && $result->memory <= $mle ) {
                continue;
            }
            if( $result->cmpError != "" ) {
                $ans = "Compilation Error";
            } else if( $result->rntError != "" ) {
                $ans = "Runtime Error";
            } else if( $result->time > $tle ) {
                $ans = "Time Limit Exceeded";
            } else if($result->memory > $mle ) {
                $ans = "Memory Limit Exceeded";
            } else {
                $ans = "Wrong Answer";
            }
            break;
        }
        $submission->result = $ans;
        $submission->save();
        
        if( $ans == "Accepted" ) {
            $flg = 1;
            if ($this->session_id == 0) {
                $ac = Accepted::where('problem_id', $this->problem_id)
                            ->where('session_id', $this->session_id)
                            ->where('user_id', $user_id)
                            ->first();
                            
                if( $ac != null ) {
                    $flg = 0;
                }
            }
            $created = Accepted::create([
                'problem_id' => $this->problem_id,
                'submission_id' => $this->submission_id,
                'session_id' => $this->session_id,
                'user_id' => $user_id
                ]);
            if( $this->session_id == 0 && $flg == 1 ) {
                $user = User::find($user_id);
                $user->solved = $user->solved + 1;
                $user->save();
            }
                
        } else {
            $created = Tried::create([
                'problem_id' => $this->problem_id,
                'submission_id' => $this->submission_id,
                'session_id' => $this->session_id,
                'user_id' => $user_id
            ]);   
        }
        
    }
    public function GiveMeOutput($code, $input, $mx_tle, $mx_mle, $lang)
    {
        $url = 'https://ide.geeksforgeeks.org/main.php';
        
        $data = array('lang' => $lang, 'code' => $code, 'input' => $input, 'save' => 'false');
        //use key 'http' even if you send the request to https://...
            // $options = array(
                //     'http' => array(
        //         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        //         'method'  => 'POST',
        //         'content' => http_build_query($data)
        //     )
        // );
        // $context  = stream_context_create($options);
        // $result = file_get_contents($url, false, $context);
        // if ($result === FALSE) { /* Handle error */ }
        // else {
            //     echo "$result->output"
        // }
        // echo "$result->output";
        //url-ify the data for the POST
        $fields_string = http_build_query($data);
        
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //execute post
        $result = curl_exec($ch);
        $result = json_decode($result);
    
        return $result;
    }
}
