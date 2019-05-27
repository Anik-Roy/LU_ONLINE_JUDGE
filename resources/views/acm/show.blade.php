@extends('inc.app')

@section('contant')
    
        <div class="container bg-white pl-5 pr-5 rounded-top">
            <div class="row">
              <div class="col-lg-12 header-col">
                  <h2>{{$problem->title}}</h2>
                  <p>time limit per test: {{$problem->time_limit}} seconds</p>
                  <p>memory limit per test: {{$problem->memory_limit}} megabytes</p>
                  <p>input: standard input</p>
                  <p>output: standard output</p>
              </div>
            </div>

            <div class="row">
                <div class="col-lg-12 body-col">
                    {!!$problem->body!!}
                    <p>You are given an array a consisting of n integers a1,a2,…,an.</p>
                    <p>Your problem is to find such pair of indices i,j (1&le;i&#60j&le;n) that lcm(ai,aj) is minimum possible.</p>
                    <p>lcm(x,y)  is the least common multiple of x and y (minimum positive number such that both x and y are divisors of this number).</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 body-col">
                    <p><b>Input</b></p>
                    <p>It is a long established fact that a reader will be distracted by the distracted by the</p>
                    <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy in their infancy in their infancy .</p>
                </div>
            </div>


            
            <div class="row">
                <div class="col-lg-12 body-col">
                    <p><b>Output</b></p>
                    <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy in their infancy in their infancy .</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 body-col">
                    <p><b>Examples</b></p>
                    <table class="table table-sm table-bordered table-striped">
                        <tr><td><strong>Input</strong></td></tr>
                        <tr><td onclick="this.select()"><pre>1 2 3 4 5 6</pre></td></tr>

                        <tr><td><strong>Output</strong></td></tr>
                        <tr><td><pre>1 2 3 4 5 6</pre></td></tr>
                    </table>
                    <table class="table table-sm table-bordered table-striped">
                        <tr><td><strong>Input</strong><button class="copy-btn btn btn-secondary" onclick='myFunction("input1")'>copy</button></td></tr>
                        <tr><td><pre>6 5 4 3 2 1</pre></td></tr>

                        <tr><td><strong>Output</strong></td></tr>
                        <tr><td><pre>1 2 3 4 5 6</pre></td></tr>
                    </table>

                    <div class="example border border-dark">
                        <div class="row input">
                            <div class="col-lg-6 border-bellow" style="height:24px">
                                <p><b>Input</b></p>
                            </div>
                            <div class="col-lg-6 border-bellow">
                                <button class="copy-btn" onclick='myFunction("input3")'>copy</button>
                            </div>
    
                            <div class="col-lg-12 copy-txt border-bellow" style="height:24px">
                                <p id="input3">1 2 3 4</p>
                            </div>
                        </div>

                        <div class="row output">
                            <div class="col-lg-6 border-bellow" style="height:24px">
                                <p><b>Output</b></p>
                            </div>
                            <div class="col-lg-6 border-bellow">
                                <button class="copy-btn">copy</button>
                            </div>

                            <div class="col-lg-12 copy-txt" style="height:24px">
                                <p>1 2 3 4</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

          </div>
    {{-- </div> --}}
    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script>
        function myFunction(v) {
            var element = document.getElementById(v);
            var range, selection, worked;

            if (document.body.createTextRange) {
            range = document.body.createTextRange();
            range.moveToElementText(element);
            range.select();
            } else if (window.getSelection) {
            selection = window.getSelection();        
            range = document.createRange();
            range.selectNodeContents(element);
            selection.removeAllRanges();
            selection.addRange(range);
            }

            try {
            document.execCommand('copy');
            alert('text copied');
            }
            catch (err) {
            alert('unable to copy text');
            }
        }
        </script>
@endsection

@section('head')
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    

    <style>
        strong{
            font-size: 15px;
        }
        .header-col {
            text-align: center;
            margin-top: 31px;
        }
        .header-col p {
            line-height: 0px;
            margin-top: 21px;
            font-size: 13px;
            /* font-family: sans-serif; */
        }

        .header-col h5 {
            margin-bottom: 28px;
            font-size: 17px;
        }
        .header-row{
            margin-top: 21px;
        }

        .body-col{
            font-size: 15px;
            margin-top: 0px;
            font-family: sans-serif;
        }
        .copy-btn {
            float: right;
            margin-right: -7px;
            width: 6%;
            height: 30%;
        }
        .example{
            border: 2px solid #EFEFEF;
            margin-bottom: 8px;
        }
        .example-two{
            margin-top: 15px;
            border: 2px solid #EFEFEF;
        }
        .example-three{
            margin-top: 15px;
            border: 2px solid #EFEFEF;
        }
        .input {
            margin-left: 0px;
            margin-right: 0px;
        }
        .copy-txt{
            background-color: #EFEFEF;
        }
        .output{
            margin-left: 0px;
            margin-right: 0px;
        }
        pre{

        }
        .border-bellow {
            /* border-bottom: 1px solid #b2beb5 */
        }
        p{
            font-family: 'Ubuntu';
        }
        </style>
@endsection

@section('sidebar')
    @include('inc.problemSidebar')
@endsection

@section('modal')
    @include('inc.submit_modal_acm')
@endsection
@section('body')
        <script>
            $(document.body).addClass('aside-menu-lg-show');
            // $('body').addClass("aside-menu-lg-show");
        </script>
@endsection