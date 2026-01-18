<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationNoteController extends Controller
{
    public function store(Request $request, Application $application)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        // pastikan milik user login
        abort_if($application->user_id !== Auth::id(), 403);

        $application->notes()->create([
            'content' => $request->content
        ]);

        return back()->with('success', 'Catatan ditambahkan');
    }
}
