@extends('layout')
@section('content')
    @if(Session::has('timelog_id'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        <?php
        date_default_timezone_set("Europe/Berlin");
        $timezone_time = date(Session::get('start_date'));
        ?>
        <script type="text/javascript">
            var currenttime = '<?php echo $timezone_time;?>';
            var servertime=new Date(currenttime);
            function padlength(l){
                var output=(l.toString().length==1)? "0"+l : l;
                return output;
            }
            function digitalClock(){
                servertime.setSeconds(servertime.getSeconds()+1);
                var timestring=padlength(servertime.getHours())+":"+padlength(servertime.getMinutes())+":"+padlength(servertime.getSeconds());
                document.getElementById("clock").innerHTML=timestring + " CEST";
            }
            window.onload=function(){
                setInterval("digitalClock()", 1000);
            }
        </script>
    @endif
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Recording time log working hours
        </div>
        <div class="card-body">
            <form name="add-timelog-post-form" id="add-timelog-post-form" method="post" action="{{url('store-form')}}">
                @csrf
                @if(Session::has('timelog_id'))
                    <div class="alert alert-success">
                        <button type="submit" class="btn btn-primary">{{ session('button') }} </button>
                        <span class="btn btn-info" id="clock"></span>
                    </div>
                    <input type="hidden" id="timelog_id" name="timelog_id" value="{{ session('timelog_id') }}">
                @else
                    <input type="hidden" id="button_type" name="button_type" value="start">
                    <div class="form-group">
                        <label for="title">Task title</label>
                        <input type="text" id="title" name="title" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="title">Projects</label>
                        <select name="project">
                            <option >Select a project to assign it</option>
                            @foreach ($projects->toArray() as $key => $value)
                                <option value="{{ $value['id'] }}">{{ $value['project_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Start Time</button>
                @endif
            </form>
        </div>
    </div>
    <br />
    <a class="btn btn-success" href="/timelogs-list">Go to list of time logs</a>
    <br />
@endsection
