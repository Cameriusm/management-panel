<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reports = Report::orderBy('created_at', 'desc')->get();
        
        return view('panel.home.reports', [
            'reports' => $reports
        ]);
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($user_id = null)
    {
        //
        if ($user_id == null) {
            $user_id = Auth::id();
            $user_id = User::find($user_id);
        } else {
            $user_id = User::find($user_id);
        }
        $user = $user_id;
        // return $user_id;
        return view('panel.home.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $new_report = new Report();
        $currentUserRole = Auth::user()->roles[0]->id;
        if ($currentUserRole >= 3) {
            $new_report->user_id = $request->user_id;
        } else {
            $new_report->user_id = Auth::user()->id;
        }
        $new_report->title = $request->title;
        $new_report->desc = $request->desc;
        $new_report->save();
        return redirect()->back()->withSuccess('Отчёт был успешно добавлен!');
        return $currentUserRole;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    // public function show(Report $report, $id)
    public function show($id)
    {
        //
        // return $id;
        $reportById = Report::where('id',$id)->first();
        return $reportById;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
