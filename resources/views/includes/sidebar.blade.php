<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>
            {{-- <li class="nav-title">Theme</li>
            <li class="nav-item">
                <a class="nav-link" href="colors.html">
                    <i class="nav-icon icon-drop"></i> Colors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="typography.html">
                    <i class="nav-icon icon-pencil"></i> Typography</a>
            </li> --}}
            
            <li class="nav-title">Components</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-puzzle"></i>Forum</a>
                <ul class="nav-dropdown-items pl-4">
                    @php
                        $id;
                    @endphp

                    <li class="nav-item">
                        <?php $id = 1;?>

                        <a class="nav-link" href="/posts">Posts</a>
                    </li>
                    <li class="nav-item">
                        <?php $id = 2;?>

                        <a class="nav-link" href="/create">Add New Post</a>
                    </li>
                    
                </ul>
            </li>
            {{--<li class="nav-item nav-dropdown">--}}
                {{--<a class="nav-link nav-dropdown-toggle" href="#">--}}
                    {{--<i class="nav-icon icon-cursor"></i>Manage Admin</a>--}}
                {{--<ul class="nav-dropdown-items">--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="{{url('admin')}}">--}}
                            {{--<i class="nav-icon icon-cursor"></i>All Admins</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{url('admin')}}">--}}
                    {{--<i class="nav-icon icon-cursor"></i>Manage Admin</a>--}}
            {{--</li>--}}

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-star"></i> ACM<span class="badge badge-primary">NEW</span></a>
                <ul class="nav-dropdown-items pl-4">
                    <li class="nav-item">
                        <a class="nav-link" href="/ACM/problemset">
                             Problems
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ACM/status">
                             Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ACM/standings">
                             Standings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="icons/simple-line-icons.html">
                             Simple Line Icons</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-bell"></i> Notifications</a>
                <ul class="nav-dropdown-items pl-4">
                    @php
                        $notifications = App\Notification::where('user_id', Auth::user()->id)->where('is_seen', 0)->get();
                    @endphp
                    @foreach($notifications as $notification)
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('show/'.$notification->post_id)}}">
                            @php
                                $user = App\User::find($notification->from_user_id);
                            @endphp

                        <strong>{{$user->name}}</strong> commented on your post</a>
                    </li>
                    @endforeach

                </ul>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="widgets.html">
                    <i class="nav-icon icon-calculator"></i> Widgets
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li> --}}
            <li class="divider"></li>
            @php
                $disabled = "";
                $badge = "primary";
                if(Auth::user()->admin == 0) {
                    $disabled = "disabled";                    
                    $badge = "secondary";                    
                }
            @endphp

            <li class="nav-title">Extras</li>
                <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle {{$disabled}}" href="#">
                        <i class="nav-icon icon-star"></i> Rejudge
                        <span class="badge badge-{{$badge}}">NEW</span>
                    </a>
                    @if (Auth::user()->admin)    
                    <ul class="nav-dropdown-items pl-4">
                        <li class="nav-item">
                            <a class="nav-link" href="/rejudgepage" target="_top">Session Submissions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/rejudgepage" target="_top">Problem Submissions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="404.html" target="_top">User's Submissions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="500.html" target="_top">All Submissions</a>
                        </li>
                    </ul>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Auth::user()->admin)
                        <a class="nav-link" href="/add-data">
                            <i class="nav-icon icon-ban"></i> Add Data   
                            <span class="badge badge-{{$badge}}">NEW</span> 
                        </a>
                    @else 
                        <a class="nav-link {{$disabled}}">
                            <i class="nav-icon icon-ban"></i> Add Data   
                            <span class="badge badge-{{$badge}}">NEW</span> 
                        </a>
                    @endif
                </li>
            
            @php
                $user = Auth::user();
            @endphp
            <br>
            {{-- <li class="nav-title">System Utilization</li> --}}
            <li class="nav-item px-3 d-compact-none d-minimized-none">
              <div class="text-uppercase mb-1">
                <small>
                  <b>Problem Solving Progress</b>
                    @php
                        $cnt_problems = count(App\Problem::where('acm', '1')->get());
                        $cnt_solved = $user->solved;
                        if( $cnt_solved == 0 ) {
                            $ratio = 0;
                            $cnt_solved = 0;
                        } else {
                            $ratio = ($cnt_solved / $cnt_problems ) * 100;
                        }
                    @endphp
                </small>
              </div>
              <div class="progress progress-xs">

                <div class="progress-bar bg-info" role="progressbar" style="width: {{$ratio}}%" aria-valuenow="25" aria-valuemin="0"
                  aria-valuemax="100"></div>
              </div>
                <small class="text-muted"> {{$cnt_solved}} / {{$cnt_problems}}</small>
            </li>
            <li class="nav-item px-3 d-compact-none d-minimized-none">
              <div class="text-uppercase mb-1">
                <small>
                  <b>Accuracy</b>
                    @php
                        $cnt_accepted = count($user->accepteds);
                        $cnt_submission = count($user->submissions);
                        if( $cnt_accepted == 0 ) {
                            $ratio = 0;
                        } else {
                            $ratio = ($cnt_accepted / $cnt_submission ) * 100;
                        }
                    @endphp
                </small>
              </div>
              <div class="progress progress-xs">
                <div class="progress-bar bg-warning" role="progressbar" style="width: {{$ratio}}%" aria-valuenow="70" aria-valuemin="0"
                  aria-valuemax="100"></div>
              </div>
              
                <small class="text-muted"> {{$cnt_accepted}}/ {{$cnt_submission}}</small>
            </li>
            <li class="nav-item px-3 mb-3 d-compact-none d-minimized-none">
                <div class="text-uppercase mb-1">
                    <small>
                        <b>Enrolled Sessions</b>
                        @php
                            $cnt_session = count(App\Session::all());
                            $cnt_mysession = count($user->sessions);
                            if( $cnt_mysession == 0 ) {
                                $ratio = 0;
                            } else {
                                $ratio = ($cnt_mysession / $cnt_session ) * 100;
                            }
                        @endphp
                    </small>
                </div>
                <div class="progress progress-xs">
                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$ratio}}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted">{{$cnt_mysession}}/{{$cnt_session}}</small>
            </li>
        </ul>
    </nav>

    <!-- /menu footer buttons -->
{{--     <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
            <i class="nav-icon icon-star"></i>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <i class="nav-icon icon-star"></i>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
            <i class="nav-icon icon-star"></i>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
            <i class="nav-icon icon-star"></i>
        </a>
    </div> --}}
    <!-- /menu footer buttons -->
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>

</div>