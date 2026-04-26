<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'description'=> 'nullable|string',
            'venue'      => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'nullable',
            'max_slots'  => 'required|integer|min:1',
            'status'     => 'required|in:draft,published',
        ]);

        Event::create(array_merge($request->all(), ['created_by' => Auth::id()]));

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'description'=> 'nullable|string',
            'venue'      => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'nullable',
            'max_slots'  => 'required|integer|min:1',
            'status'     => 'required|in:draft,published',
        ]);

        $event->update($request->all());

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}