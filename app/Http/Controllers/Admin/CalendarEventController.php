<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalendarEvent;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CalendarEventController extends Controller
{
    public function index()
    {
        return view('admin.calendar.index', [
            'events' => CalendarEvent::with('institution')->orderByDesc('starts_on')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.calendar.form', $this->formData(new CalendarEvent(['type' => 'inscripcion'])));
    }

    public function store(Request $request)
    {
        CalendarEvent::create($this->validated($request));

        return redirect()->route('admin.calendar.index')->with('status', 'Fecha agregada al calendario.');
    }

    public function edit(CalendarEvent $event)
    {
        return view('admin.calendar.form', $this->formData($event));
    }

    public function update(Request $request, CalendarEvent $event)
    {
        $event->update($this->validated($request));

        return redirect()->route('admin.calendar.index')->with('status', 'Fecha actualizada.');
    }

    public function destroy(CalendarEvent $event)
    {
        $event->delete();

        return redirect()->route('admin.calendar.index')->with('status', 'Fecha eliminada.');
    }

    private function formData(CalendarEvent $event): array
    {
        return [
            'event' => $event,
            'institutions' => Institution::higherEducation()->whereNull('parent_id')->orderBy('name')->get(),
            'types' => CalendarEvent::TYPES,
        ];
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(array_keys(CalendarEvent::TYPES))],
            'institution_id' => ['nullable', 'exists:institutions,id'],
            'starts_on' => ['required', 'date'],
            'ends_on' => ['nullable', 'date', 'after_or_equal:starts_on'],
            'description' => ['nullable', 'string', 'max:2000'],
            'url' => ['nullable', 'url', 'max:255'],
        ], [
            'ends_on.after_or_equal' => 'La fecha final no puede ser anterior a la inicial.',
        ]);
    }
}
