@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Add new project
        </div>
        <div class="card-body">
            <form name="add-project-post-form" id="add-project-post-form" method="post" action="{{url('store-project-form')}}">
                @csrf
                    <div class="form-group">
                        <label for="title">project title</label>
                        <input type="text" id="title" name="title" class="form-control" required="">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
    <br />
    <a class="btn btn-success" href="/timelogs-list">Go to list of time logs</a>
    <br />
@endsection
