<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Redirect;
use Carbon\Carbon;
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
        $user_author_role = Auth::user()->roles()->first()->pivot->role_id;
        $id = Auth::user()->id;
        $role_id = Auth::user()->roles()->first()->pivot->role_id;
        if ($role_id  == 2){
            $reports = Report::orderBy('created_at', 'desc')->where('user_id', $id)->get();
        } else {
            $reports = Report::orderBy('created_at', 'desc')->get();
        }
        return view('panel.home.reports', [
            'reports' => $reports,
            'user_author_role' => $user_author_role
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
        // return \Carbon\Carbon::now()->format('H');
        $user_author_role = Auth::user()->roles()->first()->pivot->role_id;
        $user_author_id = Auth::user()->id;
        $user_role_id = null;
        if ($user_id == null) {
            $user_id = Auth::user()->id;
            $user_id = User::find($user_id);
        } else {
            $user_id = User::find($user_id);
        }
        $user = $user_id;
        return view('panel.home.create',compact('user','user_author_role','user_role_id','user_author_id'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role_id = Auth::user()->roles()->first()->pivot->role_id;
        $time = \Carbon\Carbon::now()->format('H');
        if (($role_id == 2) && ($time >= 20 || $time < 7) ) {
            return redirect()->back()->with('error', 'Время создания отчёта для работника - c 7:00 до 20:00');
        }
        $new_report = new Report();
        switch($role_id){
            case(2):
                $new_report->user_id = Auth::user()->id;
                break;
                case(3):
                    if(Auth::user()->id == $request->user_id){
                        $new_report->user_id = $request->user_id;
                    } else {
                        $new_report->user_id = $request->user_id;
                        $new_report->created_at = $request->created_at;
                    }
                    break;
                    case(4):
                        $new_report->user_id = $request->user_id;
                    $new_report->created_at = $request->created_at;
            break;
            default:
        }
        $new_report->title = $request->title;
        $new_report->desc = $request->desc;
        $new_report->save();
        return redirect()->back()->withSuccess('Отчёт был успешно добавлен!');
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
        $user_author_role = Auth::user()->roles()->first()->pivot->role_id;
        $user_author_id = Auth::user()->id;
        if ($user_author_role == 2 && $user_author_id == $id) {
            return redirect()->back()->with('error', 'Работник может просматривать только свои отчёты!');
        }
        $reportById = Report::where('id',$id)->first();
        return $reportById;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user_author_role = Auth::user()->roles()->first()->pivot->role_id;
        $user_author_id = Auth::user()->id;
        $report = Report::where('id',$id)->first();
        if ($user_author_role == 2 && $user_author_id != $report->user_id) {
            return redirect()->back()->with('error', 'Работник может редактировать только свои отчёты!');
        }
        $user = User::find($report->user_id);
        return view('panel.home.report',compact('report','user','user_author_role','user_author_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //   
        $role_id = Auth::user()->roles()->first()->pivot->role_id;
        $hours = \Carbon\Carbon::now()->format('H');
        $date = \Carbon\Carbon::now()->toDateString();
        $reportDate = Carbon::parse($request->created_at)->toDateString();
        if ($role_id == 2) {
            if($reportDate != $date) {
                return redirect()->back()->with('error', 'Редактирование отчёта для работника - c 7:00 до 20:00 в день создания отчёта!');
            } else {
                if (($role_id == 2) && ($hours >= 20 || $hours < 7) ) {
                    return redirect()->back()->with('error', 'Время создания отчёта для работника - c 7:00 до 20:00!');
                }
            }
        }
        $current = Report::where('id', $id)->first();
        $current->title = $request->title;
        // add filter for manager created_at
        //
        //
        //
        //
        $current->created_at = $request->created_at;
        $current->desc = $request->desc;
        $current->save();
        return redirect()->back()->withSuccess('Отчёт был успешно отредактирован!');
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
