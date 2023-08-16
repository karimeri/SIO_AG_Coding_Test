@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Edit time log entry
        </div>
        <div class="card-body">
            <form name="update-form" id="update-form" method="post" action="{{url('update-row')}}">
                @csrf
                <input type="hidden" id="id" name="id" value="{{ $row->id }}">
                <div class="form-group">
                    <label for="task_title">Title</label>
                    <input type="text" id="task_title" name="task_title" class="form-control" value ="{{ $row->task_title }}" required="">
                </div>
                <div class="form-group">
                    <label for="title">Projects</label>
                    <select name="project">
                        <option >Select a project to assign it</option>
                        @foreach ($projects->toArray() as $key => $value)
                            <option @if ($value['id'] == $row->project_id) selected="selected" @endif value="{{ $value['id'] }}"  >{{ $value['project_name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="start_time_task">Start working time</label>
                    <input type="text" id="start_time_task" name="start_time_task" class="form-control" value ="{{ $row->start_time_task }}" required="">
                </div>
                <div class="form-group">
                    <label for="start_time_task">End working time</label>
                    <input type="text" id="end_time_task" name="end_time_task" class="form-control" value ="{{ $row->end_time_task }}" required="">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
