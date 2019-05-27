
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">

                    <div class="modal-content pl-5 pr-5">

                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLongTitle">Submit <b>{{$problem->title}}'s </b> Solution</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <form action="{{url($session_name.'/'.$course_name.'/submit/'.$problem->id)}}" method="POST">
                            
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="language">Choose Language</label>

                                    <select class="form-control border border-primary" name="language">
                                        <option value="c">C</option>
                                        <option value="cpp">C++</option>
                                        <option value="java">Java</option>
                                        <option value="python">Python</option>

                                    </select>
                                    <br>

                                    <label for="code">Write Your Code</label>
                                    <textarea class="form-control" name="code" rows="10" cols="50" placeholder="#include<bits/stdc++.h>
using namespace std;
int main() {
    cout << Hello world << endl;
}"></textarea>
                            
                                </div>
                            </div>
                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>    

                        </form>
                        
                    </div>
                </div>
            </div>