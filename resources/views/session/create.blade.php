@extends('inc.app')
@section('contant')

    <div class="container mt-5">
        <div class="card text-center font-weight-bolder card-accent-success" >
            <legend>Create new Course Session</legend>
        </div>


        <div class="card">
            <div class="card-body">
                <form method="post" action="{{url('session/save')}}">
                    @php
                        $now = \Illuminate\Support\Carbon::now();
                    @endphp
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <label for="year">Year: </label>
                        <input  name="year" class="form-control" type="text" value="{{$now->year}}" readonly>
                    </div>
                    <div class="row">
                        <div class="form-group col" >
                            <label for="course">Course Name: </label>
                            @php
                                $courses = App\Course::all();
                            @endphp
                            <select name="course" id="course" class="form-control border border-primary" required>
                                @foreach ($courses as $i => $course)
                                    <option value="{{$i+1}}"> {{$course->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col" >
                            <label for="session">Session: </label>
                            <select name="season" id="season" class="form-control border border-primary" required>
                                <option value="Fall-">Fall</option>
                                <option value="Spring-">Spring</option>
                                <option value="Summer">Summer</option>
                            </select>
                        </div>
                        <div class="form-group col" >
                            <label for="batch">Batch: </label>
                            <input  name="batch" id="batch" class="form-control border border-primary" type="text" required>
                            {{-- <select name="batch" id="batch" class="form-control border border-primary" required>
                                <option value="38th">38</option>
                                <option value="39th">39</option>
                                <option value="40th">40</option>
                                <option value="41st">41</option>
                                <option value="42nd">42</option>
                                <option value="43rd">43</option>
                                <option value="44th">44</option>
                                <option value="45th">45</option>
                                <option value="46th">46</option>
                                <option value="47th">47</option>
                                <option value="48th">48</option>
                                <option value="49th">49</option>
                                <option value="50th">50</option>
                                <option value="51st">51</option>
                                <option value="52nd">52</option>
                                <option value="53rd">53</option>
                            </select> --}}
                        </div>
                        <div class="form-group col" >
                            <label for="section">Section: </label>
                            <select name="section" id="section" class="form-control border border-primary" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="security">Security: </label>
                        <input type="text" name="security" class="form-control border border-primary" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success float-right" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

