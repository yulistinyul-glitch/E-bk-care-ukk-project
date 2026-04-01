<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\SelfReport;
use Carbon\Carbon;

class DashboardbkController extends Controller
{
    public function dashboard()
    {
        $hour = date('H');
        if ($hour >=5 && $hour < 12) {
            $greeting = 'GOOD MORNING';
        } elseif ( $hour >=12 && $hour <17) {
            $greeting = 'GOOD AFTERNOON';
        }elseif ($hour >=17 && $hour <20) {
            $greeting = 'GOOD EVENING';
        }else {
            $greeting = 'GOOD NIGHT';
        }

        $recentChat = Chat::with(['konseling.siswa'])
                ->where('sender_type', 'siswa')
                ->latest()
                ->get()
                ->unique('konseling_id')
                ->take(3);
        
        $todayReports = SelfReport::with('siswa')
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->get();
        return view('gurubk.dashboard', compact('greeting', 'recentChat', 'todayReports'));
    }
}
