<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) abort(403);

        // 1 query untuk semua statistik
        $stats = Application::where('user_id', $user->id)
            ->selectRaw("
                COUNT(*) as total,
                SUM(status = 'daftar') as daftar,
                SUM(status = 'interview') as interview,
                SUM(status = 'diterima') as diterima,
                SUM(status = 'ditolak') as ditolak
            ")
            ->first();
        //  
        $applications = $user->applications()->latest()->paginate(10);
        
        return view('dashboard', [
            'total'     => $stats->total,
            'daftar'    => $stats->daftar,
            'interview' => $stats->interview,
            'diterima'  => $stats->diterima,
            'ditolak'   => $stats->ditolak,
            'applications' => $applications,
        ]);
    }
}
