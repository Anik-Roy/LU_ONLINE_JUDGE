@extends('inc.app')


@section('head')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection

@section('contant')

    {{-- taskkill -im a.exe -f --}}

    @php
        
    putenv("PATH=C:\Program Files (x86)\CodeBlocks\MinGW\bin");
	$CC="g++ -std=c++11";
	$out="a.exe";
	//$code=$_POST["code"];
	//$input=$_POST["input"];
	$filename_code="main.cpp";
	$filename_in="input.txt";
	$filename_error="error.txt";
	$executable="a.exe";
	$command=$CC." -lm ".$filename_code;	
	$command_error=$command." 2>".$filename_error;
	
	
	// function setTimeout($fn, $timeout){
	// 	// sleep for $timeout milliseconds.
	// 	sleep(($timeout/1000));
	// 	$fn();
	// }
	
	// // Some example function we want to run.
	// function someFunctionToExecute(){
	// 	$taskkill = "taskkill -im a.exe -f";
	// 	shell_exec($taskkill);
	// }

	// // This will run the function after a 3 second sleep =>
	// // We're using an anonymous function to wrap the function
	// // which we wish to execute.
	// setTimeout(function(){
	// someFunctionToExecute();
	// }, 5000);

	

	//if(trim($code)=="")
	//die("The code area is empty");
	exec("taskkill -im a.exe -f");
    
    
	$file_code=fopen($filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	$file_in=fopen($filename_in,"w+");
	fwrite($file_in,$input);
    fclose($file_in);




	exec("cacls  $executable /g everyone:f"); 
	exec("cacls  $filename_error /g everyone:f");	
    $time_start = microtime(true); 
	shell_exec($command_error);
    //ini_set('max_execution_time', 0.1);
	$error=file_get_contents($filename_error);
    $executionStartTime = microtime(true);

	if(trim($error)=="")
	{
        echo "$command_error\\n";
        if(trim($input)=="")
		{
            $output=shell_exec($out);
		}
		else
		{
            $out=$out." < ".$filename_in;
            
			$output=shell_exec($out);
        }
        echo "$out";
		//echo "<pre>$output</pre>";
        echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output </textarea><br><br>";
	}
	else if(!strpos($error,"error"))
	{
		echo "<pre>$error</pre>";
		if(trim($input)=="")
		{
            $output=shell_exec($out);
		}
		else
		{
            $out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}
		echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
	}
	else
	{
        echo "<pre>$error</pre>";
	}
	$executionEndTime = microtime(true);
	$seconds = $executionEndTime - $executionStartTime;
	$seconds = sprintf('%0.2f', $seconds);
	echo "<pre>Compiled And Executed In: $seconds s</pre>";
	exec("del $filename_code");
	exec("del *.o");
	exec("del *.txt");
	exec("del $executable");
        

    @endphp

@endsection 