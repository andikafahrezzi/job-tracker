<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
         /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Start query
        $query = $user->applications();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', '%' . $search . '%')
                  ->orWhere('position', 'like', '%' . $search . '%');
            });
        }

        // Status filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Get applications with pagination
        $applications = $query->latest()->paginate(12)->withQueryString();

        // Return JSON for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $applications->items(),
                'pagination' => [
                    'total' => $applications->total(),
                    'per_page' => $applications->perPage(),
                    'current_page' => $applications->currentPage(),
                    'last_page' => $applications->lastPage(),
                    'from' => $applications->firstItem(),
                    'to' => $applications->lastItem(),
                ]
            ]);
        }
        return view('dashboard', [
            'applications' => $applications,
        ]);
    }
}
