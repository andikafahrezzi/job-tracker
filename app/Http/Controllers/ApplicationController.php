<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
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

        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        return view('applications.create');
    }

public function store(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'company_name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'salary_estimation' => 'nullable|string|max:255',
        'status' => 'required|in:daftar,interview,diterima,ditolak',
        'notes' => 'nullable|string',
    ]);

    /** @var \App\Models\User $user */
    $application = $user->applications()->create(
        collect($validated)->except('notes')->toArray()
    );

    
    if (!empty($validated['notes'])) {
        $application->notes()->create([
            'content' => $validated['notes'],
        ]);
    }

    return redirect()
        ->route('applications.index')
        ->with('success', 'Lamaran berhasil ditambahkan! 🎉');
}




    public function edit(Application $application)
    {
        // Check authorization
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }
         $application->load('notes'); 

        return view('applications.edit', compact('application'));
    }

public function update(Request $request, Application $application)
{
    if ($application->user_id !== Auth::id()) {
        abort(403);
    }

    $validated = $request->validate([
        'company_name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'salary_estimation' => 'nullable|string|max:255',
        'status' => 'required|in:daftar,interview,diterima,ditolak',
        'notes' => 'nullable|string',
    ]);


    $application->update(
        collect($validated)->except('notes')->toArray()
    );

    
    if (array_key_exists('notes', $validated)) {
        $note = $application->notes()->first();

        if ($note) {
            $note->update(['content' => $validated['notes']]);
        } elseif (!empty($validated['notes'])) {
            $application->notes()->create([
                'content' => $validated['notes'],
            ]);
        }
    }

    return redirect()
        ->route('applications.index')
        ->with('success', 'Lamaran berhasil diperbarui! ✅');
}

    public function destroy(Application $application)
    {
        // Check authorization
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $application->delete();

        return back()->with('success', 'Lamaran berhasil dihapus! 🗑️');
    }

    public function updateStatus(Request $request, Application $application)
    {
        // Check authorization
        if ($application->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $request->validate([
            'status' => 'required|in:daftar,interview,diterima,ditolak'
        ]);

        // Update status
        $application->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'status' => $application->status,
            'message' => 'Status berhasil diupdate!'
        ]);
    }

    public function getJson()
    {
        $applications = Application::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get(['id', 'company_name', 'position', 'status', 'salary_estimation', 'created_at', 'updated_at']);
        
        return response()->json($applications);
    }
}