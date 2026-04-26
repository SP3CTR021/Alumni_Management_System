<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'published')
                       ->orderBy('event_date')
                       ->get();

        return view('alumni.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $isRsvped = $event->attendees()
                          ->where('user_id', Auth::id())
                          ->wherePivot('status', 'confirmed')
                          ->exists();

        return view('alumni.events.show', compact('event', 'isRsvped'));
    }

    public function rsvp(Event $event)
    {
        $user = Auth::user();

      
        $existing = $event->attendees()->where('user_id', $user->id)->first();

        if ($existing) {

            $event->attendees()->updateExistingPivot($user->id, ['status' => 'confirmed']);
        } else {
            $event->attendees()->attach($user->id, ['status' => 'confirmed']);
        }

        return redirect()->back()->with('success', 'RSVP confirmed!');
    }

    public function cancelRsvp(Event $event)
    {
        $event->attendees()->updateExistingPivot(Auth::id(), ['status' => 'cancelled']);
        return redirect()->back()->with('success', 'RSVP cancelled.');
    }
}