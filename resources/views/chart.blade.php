@extends('layout')
@section('content')
    <h1>Chart wokring task hours / month</h1>

    <canvas id="myChart" height="100px"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript">

        var labels = {{ Js::from($labels) }};
        var hours = {{ Js::from($data) }};
        const data = {
            labels: labels,
            datasets: [{
                label: 'Working hours/month',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: hours,
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <a class="btn btn-success" href="/timelogs-list">Go to list of time logs</a>
@endsection
