<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use DB;
use PDF;

class DownloadController extends Controller
{
        public function __construct()
    {
            $this->middleware(['role:manager|admin']);
    }
    
    public function index(Request $request)
    {
        $date = Carbon::today()->toDateString();
        $users = Report::select('reports.*', 'users.name', 'users.created_at as users_created')->join('users','users.id','=','reports.user_id');
        if ($request->filled(['date'])) {
            $date = date($request->date);
            $reports = $users->whereDate('reports.created_at', $date);
        } else {
            $reports = $users->whereDate('reports.created_at', Carbon::today());
        }
        $unsubmitted = User::whereNotIn('id',$reports->pluck('user_id'))->get();
        view()->share('reports',collect([
            'reports' => $reports->get()->toArray(),
            'unsubmitted' => $unsubmitted->toArray(),
            'date' => $date,
        ])->toArray());
        $title = 'Отчёт за ' . $date . '.pdf';
        $pdf = PDF::loadView('pdfview', $reports->get()->toArray());
        return $pdf->download($title);
    }
}
