@extends('layout')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <h2>List of projects</h2>
    <br />
    <table class="table table-bordered">
        <tr>
            <th>Project Id</th>
            <th>Project name</th>
            <th>Created at</th>
        </tr>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->project_name }}</td>
                <td>{{ $project->created_at }}</td>
            </tr>
        @endforeach
    </table>
    <hr />
    <a class="btn btn-success" href="/add-new-project">Create new project</a>
    <hr />
    <a class="btn btn-success" href="/timelogs-list">Go to list of time logs</a>
@endsection
