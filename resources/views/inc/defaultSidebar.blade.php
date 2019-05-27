<div class="list-group list-group-accent">

        <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small"><i class="fas fa-user-alt"></i> {{Auth::user()->name}}</div>
        <div class="list-group-item-accent-success list-group-item-divider">
            <div class="card-body">
                @php
                    $user = App\User::find(Auth::user()->id);
                @endphp
                <p><i class="fas fa-star" style="font-size:10px"></i> Problem Solved: <strong> {{count($user->accepteds)}} </strong></p>
                <p><i class="fas fa-star" style="font-size:10px;"></i> Contribution: <strong>11</strong></p>
                <div class="row">
                        <ul style="list-style: square;" class="mt-2">
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">My Submission</a></li>
                            <li><a href="#">My Courses</a></li>
                            <li><a href="#">Talks</a></li>
                            <li><a href="#">Teams</a></li>
                            <li><a href="#">Favourites</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
        
                </div>
            </div>
        </div>
        <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small"><i class="fas fa-trophy"></i> Top Solvers</div>
        <div class="list-group-item-accent-primary list-group-item-divider">
            <div class="card-body mr-2">
                <table class="table table-striped text-center table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Solved</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $users = App\User::orderBy('solved', 'desc')->paginate(5);
                            $arr = array();
                            foreach ($users as $user ) {
                                $arr[$user->id] = count($user->accepteds);
                            }
                            arsort($arr);
                            $cnt = 1;
                        @endphp
                        @foreach ($arr as $user => $solved)
                            @php
                                $name = App\User::find($user)->name;
                            @endphp
                            <tr>
                                <td>{{$cnt++}}</td>
                                <td>
                                    <a href="#">{{str_limit(strip_tags($name, 7))}}</a>
                                </td>
                                <td>{{$solved}}</td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td>2</td>
                            <td><a href="#">Farid</a></td>
                            <td>1764</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="#">roy</a></td>
                            <td>1664</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="#">mahfuz_lu</a></td>
                            <td>1564</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><a href="#">mahbub</a></td>
                            <td>1464</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="#">Batch</a>
                |
                <a href="#">Section</a>
                <a href="#" class="float-right"> view all→</a>
            </div>
        </div>
        <div class="list-group-item list-group-item-accent-danger list-group-item-divider">
            <div>
            <strong>#10 Startups.Garden</strong> Meetup</div>
            <small class="text-muted mr-3">
            <i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
            <small class="text-muted">
            <i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
        </div>
        <div class="list-group-item list-group-item-accent-primary list-group-item-divider">
            <div>
            <strong>Team meeting</strong>
            </div>
            <small class="text-muted mr-3">
            <i class="icon-calendar"></i>&nbsp; 4 - 6pm</small>
            <small class="text-muted">
            <i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
            <div class="avatars-stack mt-2">
            <div class="avatar avatar-xs">
                <img class="img-avatar" src="/img/avatars/2.jpg" alt="admin@bootstrapmaster.com">
            </div>
            <div class="avatar avatar-xs">
                <img class="img-avatar" src="/img/avatars/3.jpg" alt="admin@bootstrapmaster.com">
            </div>
            <div class="avatar avatar-xs">
                <img class="img-avatar" src="/img/avatars/4.jpg" alt="admin@bootstrapmaster.com">
            </div>
            <div class="avatar avatar-xs">
                <img class="img-avatar" src="/img/avatars/5.jpg" alt="admin@bootstrapmaster.com">
            </div>
            <div class="avatar avatar-xs">
                <img class="img-avatar" src="/img/avatars/6.jpg" alt="admin@bootstrapmaster.com">
            </div>
            <div class="avatar avatar-xs">
                <img class="img-avatar" src="/img/avatars/7.jpg" alt="admin@bootstrapmaster.com">
            </div>
            <div class="avatar avatar-xs">
                <img class="img-avatar" src="/img/avatars/8.jpg" alt="admin@bootstrapmaster.com">
            </div>
         </div>
    </div>
</div>

{{-- <div class="row mb-4">
    <div class="col">
        <div class="card card-primary blog-post shadow">
            <div class="card-header" style="background-color: #f3f3f3">
                <a href="#" class="ml-2" style="font-size: 19px;"><i class="fas fa-angle-right"></i> Pay Attention</a>
            </div>
            <div class="card-body">
                <button class="btn btn-outline-dark active text-center mt-0">
                    C Programing assignment
                </button>
                <table class="table table-hover table-inverse mt-3 table-sm">
                    <tbody>
                        <tr>
                            <td>
                                <li><a href="#">Ali Baba's Diamond</a></li>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <li><a href="#">Piramid</a></li>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <li><a href="#">Counting Bulbs</a></li>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <li><a href="#">Unique Balls</a></li>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="card-footer">
                <a href="#"><i class="fas fa-user"></i> Ashraful islam Shawon</a>

                <br>
                <a href="#">
                    <i class="far fa-calendar-alt"></i>
                    <strong> <abbr title="Last date" style="text-decoration: none;"> 15 dec 2018</abbr></strong>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col">
        <div class="card card-primary blog-post shadow">
            <div class="card-header head_col text-center" style="">
                <a href="#" class="ml-2" style="font-size:19px;"><i class="fas fa-user-alt"></i> {{Auth::user()->name}} </a>
            </div>
            <div class="card-body">
                <p class="mb-1 ml-3"><i class="fas fa-sort-amount-up small"></i> Problem Solved: <strong>{{ count(Auth::user()->accepted) }} </strong>
                </p>
                <p><i class="fas fa-star mb-2 ml-3"></i> Contribution: <strong>11</strong></p>
                <div class="row">
                    <div class="col-md-7">
                        <ul style="list-style: square;" class="mt-2">
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">My Submission</a></li>
                            <li><a href="#">My Courses</a></li>
                            <li><a href="#">Talks</a></li>
                            <li><a href="#">Teams</a></li>
                            <li><a href="#">Favourites</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-md-5" style="">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <div class="card card-primary blog-post shadow">
            <div class="card-header head_col text-center">
                <a href="#" class="ml-2 font-weight-bold" style="font-size:19px;"><i class="fas fa-trophy"></i> Top
                    Solvers</a>
            </div>
            <div class="card-body m-0">
                <table class="table table-striped text-center m-0 table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Solved</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="#">the_badcoder</a></td>
                            <td>1864</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="#">Farid</a></td>
                            <td>1764</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="#">roy</a></td>
                            <td>1664</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="#">mahfuz_lu</a></td>
                            <td>1564</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><a href="#">mahbub</a></td>
                            <td>1464</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="#">Batch</a>
                |
                <a href="#">Section</a>
                <a href="#" class="float-right"> view all→</a>
            </div>
        </div>
    </div>
</div>


{{-- 
<div class="portlet light">
                <div class="portlet-title">
                    <div class="caption caption-md"><span class="caption-subject">Submit</span></div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided"><button class="btn default btn-code-panel"
                                data-code-panel="codePanel5c78db5ba0831f00014e7afc">
                                Open IDE</button></div>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="/p/proper-leap-years/submit" method="post" enctype="multipart/form-data">
                        <div class="form-group"><select name="languageId" class="form-control select2-hidden-accessible"
                                data-sticky="problemView:submitForm:language" tabindex="-1" aria-hidden="true">
                                <option value="5847f40e04469e596eed83bc">Bash
                                </option>
                                <option value="55b4af33421aa95e80000001">C
                                </option>
                                <option value="55b4af45421aa95e80000002">C++
                                </option>
                                <option value="55ba77b2421aa92da4000003">C++11
                                </option>
                                <option value="584859c204469e2585024499">C++14
                                </option>
                                <option value="55c9ab8c421aa961d1000007">Go
                                </option>
                                <option value="55b4af57421aa95e80000003">Java
                                </option>
                                <option value="58483d7504469e2585024395">Java 8
                                </option>
                                <option value="5848364d04469e2585024363">JavaScript
                                </option>
                                <option value="59ca12114ad24000017dcaf9">Kotlin
                                </option>
                                <option value="5848471304469e25850243ea">PHP
                                </option>
                                <option value="55c9a6a6421aa961d1000003">PyPy 3
                                </option>
                                <option value="58482b5504469e2585024320">Python
                                </option>
                                <option value="58482c1804469e2585024324">Python 3
                                </option>
                                <option value="5848505704469e258502445b">Ruby</option>
                            </select><span class="select2 select2-container select2-container--bootstrap select2-container--below" dir="ltr" style="width: 220.5px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-languageId-gr-container"><span class="select2-selection__rendered" id="select2-languageId-gr-container" title="C++14">C++14 </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                        <div class="form-group"><input type="file" name="source" class="form-control"></div><button
                            class="btn blue">Submit</button>
                    </form>
                </div>
            </div> --}} --}}