@extends('inc.app')



@section('contant')

    <div class="container-fluid row cspace2 slideanim justify-content-center">
        <div class="col">
            <div class="form-group">
                {{-- <form action="{{url('/compile')}}"method="POST" id="oForm"> --}}
<form action="#"  id="oForm">
                    {{ csrf_field() }}
                    
                    <div class="row">
                        <div class="col-8">
                            <label for="code">Write Your Code</label>
                            <div id="editor" name="code">
#include "iostream"
using namespace std;

int main() {
    printf("hello world");
    return 0;
}</div>

                        </div>
                        <div class="col">
                            <div class="row">
                               <label for="language">Choose Language</label>

                                <select class="form-control" name="language">
                                    <option value="c">C</option>
                                    <option value="cpp">C++</option>
                                    <option value="java">Java</option>
                                    <option value="python">python</option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="input">Enter Your Input</label>
                                <textarea class="form-control" name="input" rows="7"></textarea><br><br>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    

                    <div class="btn btn-success runbtn ld-ext-right" id="arun" style="cursor: pointer">
                        Run Code
                    </div>
                    {{-- <input type="button" class="btn btn-success runbtn" id="arun" value="Run Code"><br><br><br> --}}
                    {{-- <input type="submit" class="btn btn-success" id="run" value="Run Code"><br><br><br> --}}
                    <div class="row ml-2">
                        {{-- <label for="output">Output</label> --}}
                        <div id="output" name="output"></div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    
@endsection 

@section('body')

    {{-- Helpful Link --}}
    {{-- https://ace.c9.io/#nav=howto --}}

    <!-- load ace -->
    <script src="/ace-builds/src-noconflict/ace.js"></script>
    <!-- load ace language tools -->
    <script src="/ace-builds/src-noconflict/ext-language_tools.js"></script>
    <script>
        // trigger extension
        ace.require("/ace-builds/ext/language_tools");
        var editor = ace.edit("editor");
        editor.session.setMode("ace/mode/c_cpp");
        editor.setTheme("ace/theme/tomorrow_night");
        // enable autocompletion and snippets
        editor.setOptions({
            enableBasicAutocompletion: true,
            enableSnippets: true,
            enableLiveAutocompletion: true
        });

        function run() {
            var code = editor.getValue();
            console.log(code);
            try {
                var rr = document.getElementById("codePanel");
                rr.style.display = "block";
                /*rr.innerText = code;
                console.log(rr);*/
            } catch(e) {
                console.log(e);
                // report error...
            }
        }
    </script>

    <script src="/ace-builds/show_own_source.js"></script>
    <script>

            $(document).ready(function(){  
                $('#arun').click(function(){ 
                    var oForm = document.getElementById('oForm');
                    var e = oForm.elements['language'];
                    var lang = e.options[e.selectedIndex].text;
                    var code = editor.session.getValue();
                    var input = oForm.elements['input'].value;
                    var runbtn = document.querySelector('.runbtn');
                    console.log("clicked");
                    
                    $.ajax({  
                            url:"runcode",  
                            method:"get",  
                            data:{lang:lang, code:code, input:input}, 
                            beforeSend: function(){
                                $('#arun').addClass('disabled');
                                $('#output').html('');
                            },
                            complete: function(){
                                // runbtn.classList.remove('running');
                            },
                            success:function(data){  
                                $('#arun').removeClass('disabled');
                                $('#output').html(data);
                                
                            } 
                            
                    });
/*                     $.ajax({  
                            url:"https://ide.geeksforgeeks.org/main.php",  
                            method:"post",
                            data: { lang:"Cpp14", code:code, input:input, save: false },

                            success:function(data){  
                                $('#output').html(data);
                                
                            } 
                            
                    }); */
                });  
            });
        </script>

        
@endsection


@section('head')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <style>
    
    	    #editor { 
		        
		        font-size: 14px;
		        /* position: absolute; */
		        height: 450px;
		        width: 100%;
		    }
    </style>
@endsection
