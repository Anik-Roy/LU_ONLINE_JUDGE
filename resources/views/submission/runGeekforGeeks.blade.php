
@php
	
	$url = 'https://ide.geeksforgeeks.org/main.php';
	$code=$_GET["code"];
	$input=$_GET["input"];
	$lang=$_GET["lang"];
	
	if( $lang == "C++" ) $lang = "Cpp14";
	if( $lang == "python" ) $lang = "Python";

	$data = array('lang' => $lang, 'code' => $code, 'input' => $input, 'save' => 'false');

	//use key 'http' even if you send the request to https://...
	// $options = array(
	// 	'http' => array(
	// 		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	// 		'method'  => 'POST',
	// 		'content' => http_build_query($data)
	// 	)
	// );


	// $context  = stream_context_create($options);
	// $result = file_get_contents($url, false, $context);
	// if ($result === FALSE) { /* Handle error */ }
    // else {
    //      echo "$result";
    // }
	// echo "$result->output";
	//url-ify the data for the POST
	
$fields_string = http_build_query($data);
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($data));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

$result = curl_exec($ch);
$result = json_decode($result);
    
@endphp


<strong>Output</strong>

@php

	if($result->cmpError == "")
	{
		//echo "<pre>$output</pre>";
        echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$result->output </textarea><br><br>";
	}

	else
	{
        echo "<pre>$result->cmpError</pre>";
	}
	echo "<pre>Compiled And Executed In: $result->time s</pre>";
	echo "<pre>Memory took: $result->memory s</pre>";


@endphp