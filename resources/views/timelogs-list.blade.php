@extends('layout')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script>
        function exportTasks(_this) {
            let _url = $(_this).data('href');
            window.location.href = _url;
        }
    </script>
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <h2>List of working time logs</h2>
    <br />
    <p data-href="expot-timelogs" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export to CSV</p>
    <br />
    <table class="table table-bordered">
        <tr>
            <th>Task Id</th>
            <th>Task Title</th>
            <th>Project Id</th>
            <th>Task End Time</th>
            <th>Working Hours</th>
            <th>Created at</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($timelogs as $timelog)
            <tr>
                <td>{{ $timelog->id }}</td>
                <td>{{ $timelog->task_title }}</td>
                <td>{{ $timelog->project_id }}</td>
                <td>{{ $timelog->start_time_task }}</td>
                <td>{{ $timelog->end_time_task }}</td>
                <td>{{ $timelog->working_hours }}</td>
                <td>{{ $timelog->created_at }}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('my-edit', ['row_id' => $timelog->id])}}">Edit</a>
                    <hr />
                    <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this row?');" href="{{route('my-delete', ['row_id' => $timelog->id])}}">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
    <a class="btn btn-success" href="/add-new-timelog"> Create New Timelog Task</a>
    <a class="btn btn-success" href="/chartjs"> Show your timelogs tasks in Chart</a>
    <br />
    <hr />
    <a class="btn btn-success" href="/projects-list">Go to projects list</a>
    <br />
    <hr />
@endsection
