<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'body'     => 'required|string',
            'category' => 'required|in:news,job,scholarship,notice',
            'status'   => 'required|in:draft,published',
        ]);

        Announcement::create(array_merge($request->all(), [
            'created_by'   => Auth::id(),
            'published_at' => $request->status === 'published' ? now() : null,
        ]));

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement posted.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'body'     => 'required|string',
            'category' => 'required|in:news,job,scholarship,notice',
            'status'   => 'required|in:draft,published',
        ]);

        $announcement->update(array_merge($request->all(), [
            'published_at' => $request->status === 'published' ? now() : null,
        ]));

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted.');
    }
}