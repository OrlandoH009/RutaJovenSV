<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return view('admin.questions.index', [
            'questions' => Question::withCount('options')->orderBy('order')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.questions.form', ['question' => new Question]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
            'interest_key' => ['nullable', 'string', 'max:100'],
        ]);

        $question = Question::create($validated);

        return redirect()->route('admin.questions.edit', $question)->with('status', 'Pregunta creada. Ahora agrega sus opciones.');
    }

    public function edit(Question $question)
    {
        $question->load('options');

        return view('admin.questions.form', [
            'question' => $question,
            'interestKeys' => config('interests.labels'),
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'text' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
            'interest_key' => ['nullable', 'string', 'max:100'],
        ]);

        $question->update($validated);

        return redirect()->route('admin.questions.index')->with('status', 'Pregunta actualizada.');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')->with('status', 'Pregunta eliminada.');
    }

    public function addOption(Request $request, Question $question)
    {
        $validated = $request->validate([
            'text' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
            'weights' => ['nullable', 'array'],
        ]);

        $weights = collect($validated['weights'] ?? [])
            ->map(fn ($value) => (int) $value)
            ->filter(fn ($value) => $value > 0)
            ->toArray();

        $question->options()->create([
            'text' => $validated['text'],
            'order' => $validated['order'],
            'interest_weights' => $weights,
        ]);

        return back()->with('status', 'Opción agregada.');
    }

    public function removeOption(Question $question, int $option)
    {
        $question->options()->where('id', $option)->delete();

        return back()->with('status', 'Opción eliminada.');
    }
}
