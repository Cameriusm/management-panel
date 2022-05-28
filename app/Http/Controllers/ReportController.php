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
        $author = Auth::user();
        $author_role = $author->roles()->first()->pivot->role_id;
        $id = $author->id;
        if ($author_role  == 2){
            $reports = Report::orderBy('created_at', 'desc')->where('user_id', $id)->get();
        } else {
            $reports = Report::orderBy('created_at', 'desc')->get();
        }
        return view('panel.home.reports', compact('reports','author_role'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $author = Auth::user();
        $author_id = $author->id;
        $author_role = $author->roles()->first()->pivot->role_id;
        if ($id == null) {
            $id = User::find($author_id);
        } else {
            $id = User::find($id);
        }
        $user = $id;
        return view('panel.home.create',compact('user','author_role','author_id'));
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
        // Check if report for today's date exists
        // return 'foo';
        
        $author_id = Auth::user()->id;
        $current_report = Report::where('user_id',$author_id)->orderBy('created_at', 'DESC')->first()->created_at->toDateString();
        if ($author_id == $request->user_id && $current_report == \Carbon\Carbon::now()->toDateString()){
            return redirect()->back()->with('error', 'Отчёт за сегодняшний день уже существует');
        }
        // return $current_report;
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
        $author = Auth::user();
        $author_role = $author->roles()->first()->pivot->role_id;
        $author_id = $author->id;
        $reportById = Report::where('id',$id)->first();
        if ($author_role == 2 && $author_id != $reportById->user_id) {
            return redirect()->back()->with('error', 'Работник может просматривать только свои отчёты!');
        }
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
        $author = Auth::user();
        $author_role = $author->roles()->first()->pivot->role_id;
        $author_id = $author->id;
        $report = Report::where('id',$id)->first();
        if ($author_role == 2 && $author_id != $report->user_id) {
            return redirect()->back()->with('error', 'Работник может редактировать только свои отчёты!');
        }
        $user = User::find($report->user_id);
        return view('panel.home.report',compact('report','user','author_role','author_id'));
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
        $author = Auth::user();
        $role_id = $author->roles()->first()->pivot->role_id;
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
        $user_id = Report::find($id)->user_id;
        $author_id = $author->id;
        $current = Report::where('id', $id)->first();
        if ($role_id == 2 || ($role_id == 3 && $author_id == $user_id) ) {
            $current->created_at = $current->created_at;
        } else {
            $current->created_at = $request->created_at;
        }
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
    public function destroy( $id)
    {
        $author = Auth::user();
        $author_role = $author->roles()->first()->pivot->role_id;
        $author_id = $author->id;
        $report = Report::find($id);
        if ($author_role == 2) {
            return redirect()->back()->with('error', 'Работник не может удалять отчёты!');
        }
        $report->delete();
        return redirect()->back()->withSuccess('Отчёт был успешно удалён!');
    }
}
