<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $applications = $user->applications()->latest()->paginate(10);

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
            'salary_estimation' => 'nullable|integer',
            'status' => 'required|in:daftar,interview,diterima,ditolak',
        ]);
        /** @var \App\Models\User $user */
        $user->applications()->create($validated);

        return redirect()->route('applications.index')->with('success', 'Lamaran berhasil ditambahkan');
    }

    public function edit(Application $application)
    {
        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary_estimation' => 'nullable|integer',
            'status' => 'required|in:daftar,interview,diterima,ditolak',
        ]);

        $application->update($validated);

        return redirect()->route('applications.index')->with('success', 'Lamaran berhasil diperbarui');
    }

    public function destroy(Application $application)
    {
        $application->delete();

        return back()->with('success', 'Lamaran berhasil dihapus');
    }

public function updateStatus(Request $request, Application $application)
{
    $request->validate([
        'status' => 'required|in:daftar,interview,diterima,ditolak'
    ]);

    // Update DB
    $application->status = $request->status;
    $application->save();

    return response()->json([
        'success' => true,
        'status' => $application->status
    ]);
}

public function getJson()
{
    $applications = Application::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get(['id', 'company_name', 'position', 'status', 'applied_at', 'created_at']);
    
    return response()->json($applications);
}
}
