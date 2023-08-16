<?php

namespace App\Http\Controllers;

use App\Models\Timelogs;
use App\Models\Projects;
use Illuminate\Http\Request;
use Session;
use DB;

class TimelogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timelogs = Timelogs::all();
        return view('timelogs-list')->with('timelogs',$timelogs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $date = date('Y-m-d H:i:s', time());
        Session::put('start_date', $date);
        $projects = Projects::all();
        return view('add-new-timelog-form')->with('projects',$projects);
    }

    /**
     * Store a newly created time log in storage.
     */
    public function store(Request $request)
    {
        //configuration to use Europe/Berlin time zone
        date_default_timezone_set('Europe/Berlin');
        $date = date('Y-m-d H:i:s', time());

        //Start log time task
        if($request->button_type == 'start') {
            $timelog = new Timelogs;
            $timelog->task_title = $request->title;
            $timelog->project_id = $request->project;
            $timelog->start_time_task = $date;
            $timelog->end_time_task = null;
            $timelog->working_hours = null;
            $timelog->save();
            Session::put('timelog_id', $timelog->id);
            Session::put('message', 'Time log task is started');
            Session::put('button', 'Stop Time');
            Session::put('start_date', $date);
            return redirect('add-new-timelog');
        }
        //Stop log time task
        else {
            $update = Timelogs::find($request->timelog_id);
            $update->end_time_task = $date;
            $hours = $this->getHours($update->start_time_task,$date);
            $update->working_hours = $hours;
            $update->update();
            Session::forget('timelog_id');
            Session::forget('message');
            Session::forget('button');
            Session::forget('start_date');
            return redirect('timelogs-list');
        }
    }

    /**
     * get number of hours between two dates
     */
    public function getHours($start_date,$end_date) {
        $start_date = strtotime( $start_date );
        $end_date = strtotime( $end_date );
        $diff = $end_date - $start_date;
        $hours = $diff / ( 60 * 60 );
        return $hours;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($row_id)
    {
       if(isset($row_id)) {
           $row = Timelogs::where('id', $row_id)->first();
           $projects = Projects::all();
           return view('edit-timelog-form', compact('row'))->with('projects',$projects);
       }
       //if no row id redirect to list time logs
       return redirect('timelogs-list');
    }

    /**
     * Update the specified time log in storage.
     */
    public function update(Request $request)
    {
        if(isset($request->id)) {
            $update = Timelogs::find($request->id);
            $update->task_title = $request->task_title;
            $update->project_id = $request->project;
            $update->start_time_task = $request->start_time_task;
            $update->end_time_task = $request->end_time_task;
            $hours = $this->getHours($request->start_time_task, $request->end_time_task);
            $update->working_hours = $hours;
            $update->update();
            return redirect('timelogs-list')->with('message', 'row updated successfully');
        }
        //if no row id redirect to list time logs
        return redirect('timelogs-list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($row_id)
    {
        if(isset($row_id)) {
            Timelogs::find($row_id)->delete();
            return redirect('timelogs-list')->with('message','row deleted successfully');
        }
        //if no row id redirect to list time logs
        return redirect('timelogs-list');
    }

    /**
     * Show data in chart.
     */
    public function chartshow()

    {
        $working_hours = Timelogs::select(DB::raw("sum(working_hours) as hours"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->orderBy(DB::raw('Month(created_at)'))
            ->pluck('hours', 'month_name');

        $labels = $working_hours->keys();
        $data   = $working_hours->values();
        return view('chart', compact('labels', 'data'));

    }

    /**
     * Export time logs data to csv file.
     */
    public function exportCsv()
    {
        $fileName = 'timelogs.csv';
        $tasks = Timelogs::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Task Title', 'Project Id', 'Start Time', 'End Time', 'Working Hours','Created At');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['Task Title']  = $task->task_title;
                $row['Project Id']  = $task->project_id;
                $row['Start Time']  = $task->start_time_task;
                $row['End Time']    = $task->end_time_task;
                $row['Working Hours']  = $task->working_hours;
                $row['Created At']  = $task->created_at;

                fputcsv($file, array($row['Task Title'], $row['Project Id'], $row['Start Time'], $row['End Time'],$row['Working Hours'], $row['Created At']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
