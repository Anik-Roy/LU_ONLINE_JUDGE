@php
    // For Python code excecution
    putenv("PATH=C:\Users\\farid\AppData\Local\Programs\Python\Python37-32");
	$CC="python";
	$out="main.py";
	$code=$_GET["code"];
	$input=$_GET["input"];
	$filename_code="main.py";
	$filename_in="input.txt";
	$filename_error="error.txt";
	$executable="main.py";
	$command=$CC." ".$filename_code;	
	$command_error=$command." 2>".$filename_error;

	echo $command . " {} " . $command_error. " {} " . $code . " {} ";
	
	
	// exec("taskkill -im a.exe -f");
    
    
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
    
@endphp

<strong>Output</strong>


@php
	echo shell_exec($out). '*\n';

	if(trim($error)=="")
	{
        if(trim($input)=="")
		{
            $output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			
			$output=shell_exec($out);
        }
    
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

{{-- 
@php
    
    putenv("PATH=C:\Program Files (x86)\CodeBlocks\MinGW\bin");
	$CC="g++ -std=c++11";
	$out="a.exe";
	$code=$_GET["code"];
	$input=$_GET["input"];
	$filename_code="main.cpp";
	$filename_in="input.txt";
	$filename_error="error.txt";
	$executable="a.exe";
	$command=$CC." -lm ".$filename_code;	
	$command_error=$command." 2>".$filename_error;

	echo $command . " {} " . $command_error. " {} ";
	
	
	// exec("taskkill -im a.exe -f");
    
    
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
    
@endphp

<strong>Output</strong>


@php

	if(trim($error)=="")
	{
        if(trim($input)=="")
		{
            $output=shell_exec($out);
		}
		else
		{
            $out=$out." < ".$filename_in;
            echo $out . "\n";
			$output=shell_exec($out);
        }
    
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
        

@endphp --}}