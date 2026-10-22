<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\CalendarEvent;

class CalendarController extends Controller
{
    public function index()
    {
        $events = CalendarEvent::with('institution')->orderBy('starts_on')->get();

        return view('calendar.index', [
            'events' => $events->map(fn (CalendarEvent $e) => [
                'id' => $e->id,
                'title' => $e->title,
                'type' => $e->type,
                'start' => $e->starts_on->toDateString(),
                'end' => ($e->ends_on ?? $e->starts_on)->toDateString(),
                'institution_id' => $e->institution_id,
                'institution' => $e->institution?->short_name,
                'description' => $e->description,
                'url' => $e->url,
            ])->values(),
            'institutions' => $events->pluck('institution')->filter()->unique('id')->sortBy('name')->values(),
            'types' => CalendarEvent::TYPES,
        ]);
    }
}
