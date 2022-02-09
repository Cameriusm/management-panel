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
        if ($request->filled(['start', 'end'])) {
            $from = date($request->start);
            $to = date($request->end);
            $reports = Report::select('reports.*', 'users.name', 'users.created_at as users_created')->join('users','users.id','=','reports.user_id')->whereBetween('reports.created_at', [$from, $to])->get()->toArray();
        } else {
            $reports = Report::select('reports.*', 'users.name', 'users.created_at as users_created')->join('users','users.id','=','reports.user_id')->whereDate('reports.created_at', Carbon::today())->get()->toArray();
        }
        view()->share('reports',$reports);
        $title = 'Отчёты за ' . $request->dates . '.pdf';
        $pdf = PDF::loadView('pdfview', $reports);
        return $pdf->download($title);
    }
}
