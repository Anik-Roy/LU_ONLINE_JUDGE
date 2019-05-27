<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-brand" href="#">
        <img class="navbar-brand-full img-avatar pl-2" src="/img/codelablogo.png" alt="CodeLab Logo">
        {{-- <img class="navbar-brand-full" src="/img/brand/logo.svg" width="89" height="25" alt="CoreUI Logo"> --}}
        <img class="navbar-brand-minimized" src="/img/brand/sygnet.svg" width="30" height="30" alt="CoreUI Logo">
    </div>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="/home">Dashboard</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="/posts">Forum</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="/contests">Contests</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="/submissions">Submissions</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="/compiler">Compiler</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="/about">About</a>
        </li>
    </ul>
    @php
        $auth_id = Auth::user()->id;
    @endphp
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown d-md-down-none">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-bell"></i>
              @php
                $notifications = App\Notification::where('user_id', $auth_id)->where('is_seen', 0)->get();
              @endphp
              <span class="badge badge-pill badge-danger">{{count($notifications)}}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
            <div class="dropdown-header text-center">
              <strong>{{"You have ". count($notifications). " notifications"}}</strong>
            </div>

            @foreach($notifications as $notification)
                <a class="dropdown-item" href="{{url('show/'.$notification->post_id)}}" style="font-size: 80%;">
                    @php
                        $user = App\User::find($notification->from_user_id);
                    @endphp
                    
                    <strong>{{$user->name}}</strong> commented on your post</a>
            @endforeach



            {{-- <div class="dropdown-header text-center">
              <strong>System Utilization</strong>
            </div>
            <a class="dropdown-item" href="#">
              <div class="text-uppercase mb-1">
                <small>
                  <b>CPU Usage</b>
                </small>
              </div>
              <span class="progress progress-xs">
                <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                  aria-valuemax="100"></div>
              </span>
              <small class="text-muted">348 Processes. 1/4 Cores.</small>
            </a>
            <a class="dropdown-item" href="#">
              <div class="text-uppercase mb-1">
                <small>
                  <b>Memory Usage</b>
                </small>
              </div>
              <span class="progress progress-xs">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </span>
              <small class="text-muted">11444GB/16384MB</small>
            </a>
            <a class="dropdown-item" href="#">
              <div class="text-uppercase mb-1">
                <small>
                  <b>SSD 1 Usage</b>
                </small>
              </div>
              <span class="progress progress-xs">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </span>
              <small class="text-muted">243GB/256GB</small>
            </a> --}}
          </div>
        </li>
        {{-- <li class="nav-item dropdown d-md-down-none">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="icon-list"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
            <div class="dropdown-header text-center">
              <strong>You have 5 pending tasks</strong>
            </div>
            <a class="dropdown-item" href="#">
              <div class="small mb-1">Upgrade NPM &amp; Bower
                <span class="float-right">
                  <strong>0%</strong>
                </span>
              </div>
              <span class="progress progress-xs">
                <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                  aria-valuemax="100"></div>
              </span>
            </a>
            <a class="dropdown-item" href="#">
              <div class="small mb-1">ReactJS Version
                <span class="float-right">
                  <strong>25%</strong>
                </span>
              </div>
              <span class="progress progress-xs">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </span>
            </a>
            <a class="dropdown-item" href="#">
              <div class="small mb-1">VueJS Version
                <span class="float-right">
                  <strong>50%</strong>
                </span>
              </div>
              <span class="progress progress-xs">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </span>
            </a>
            <a class="dropdown-item" href="#">
              <div class="small mb-1">Add new layouts
                <span class="float-right">
                  <strong>75%</strong>
                </span>
              </div>
              <span class="progress progress-xs">
                <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                  aria-valuemax="100"></div>
              </span>
            </a>
            <a class="dropdown-item" href="#">
              <div class="small mb-1">Angular 2 Cli Version
                <span class="float-right">
                  <strong>100%</strong>
                </span>
              </div>
              <span class="progress progress-xs">
                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </span>
            </a>
            <a class="dropdown-item text-center" href="#">
              <strong>View all tasks</strong>
            </a>
          </div>
        </li> --}}
        {{-- <li class="nav-item dropdown d-md-down-none">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="icon-envelope-letter"></i>
                <span class="badge badge-pill badge-info">7</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                <div class="dropdown-header text-center">
                    <strong>You have 4 messages</strong>
                </div>
                <a class="dropdown-item" href="#">
                <div class="message">
                    <div class="py-3 mr-3 float-left">
                        <div class="avatar">
                            <img class="img-avatar" src="/img/avatars/7.jpg" alt="admin@bootstrapmaster.com">
                                <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                <div>
                    <small class="text-muted">John Doe</small>
                    <small class="text-muted float-right mt-1">Just now</small>
                </div>
                <div class="text-truncate font-weight-bold">
                    <span class="fa fa-exclamation text-danger"></span> Important message
                </div>
                <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
            </div>
            <a class="dropdown-item" href="#"></a>
            <div class="message">
                <div class="py-3 mr-3 float-left">
                    <div class="avatar">
                        <img class="img-avatar" src="/img/avatars/6.jpg" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-warning"></span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">John Doe</small>
                    <small class="text-muted float-right mt-1">5 minutes ago</small>
                </div>
                <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
            </div>
            </a>
            <a class="dropdown-item" href="#">
                <div class="message">
                    <div class="py-3 mr-3 float-left">
                        <div class="avatar">
                            <img class="img-avatar" src="/img/avatars/5.jpg" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-danger"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">John Doe</small>
                        <small class="text-muted float-right mt-1">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
                </div>
            </a>
            <a class="dropdown-item" href="#">
                <div class="message">
                    <div class="py-3 mr-3 float-left">
                        <div class="avatar">
                            <img class="img-avatar" src="/img/avatars/4.jpg" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-info"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">John Doe</small>
                        <small class="text-muted float-right mt-1">4:03 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
                </div>
            </a>
            <a class="dropdown-item text-center" href="#">
                <strong>View all messages</strong>
            </a>
            </div>
        </li> --}}
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="/img/top_image.png" alt="user image">
                <span><b>{{Auth::user()->name}}</b></span>
                {{-- <img class="img-avatar" src="/img/avatars/6.jpg" alt="admin@bootstrapmaster.com"> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-bell-o"></i> Updates
                    <span class="badge badge-info">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-envelope-o"></i> Messages
                    <span class="badge badge-success">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-tasks"></i> Tasks
                    <span class="badge badge-danger">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-comments"></i> Comments
                    <span class="badge badge-warning">{{count(Auth::user()->comments)}}</span>
                </a>
                <div class="dropdown-header text-center">
                    <strong>Settings</strong>
                </div>
                <a class="dropdown-item" href="/profile/{{Auth::user()->id}}">
                    <i class="fa fa-user"></i> Profile</a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-wrench"></i> Settings</a>
                <a class="dropdown-item" href="/home/my">
                    <i class="fa fa-file"></i> Sessions
                    <span class="badge badge-primary">{{count(Auth::user()->sessions)}}</span>
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    {{-- <a class="dropdown-item" href="{{ route('logout') }}"> --}}
                   <i class="fa fa-lock"></i> Logout
                  </a>
            </div>
        </li>
    </ul>
    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show" @yield('disable')>
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>