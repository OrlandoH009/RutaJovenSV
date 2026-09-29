<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Services\InterestProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionnaireController extends Controller
{
    public function show(Request $request)
    {
        $questions = Question::with('options')->orderBy('order')->get();

        $answeredIds = $request->user()->answers()->pluck('question_option_id', 'question_id');

        return view('questionnaire.show', [
            'questions' => $questions,
            'answeredIds' => $answeredIds,
        ]);
    }

    public function store(Request $request, InterestProfileService $interestProfileService)
    {
        $questions = Question::with('options')->get();

        $rules = [];
        foreach ($questions as $question) {
            $rules["answers.{$question->id}"] = ['required', 'integer', 'exists:question_options,id'];
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($request, $validated) {
            foreach ($validated['answers'] as $questionId => $optionId) {
                UserAnswer::updateOrCreate(
                    ['user_id' => $request->user()->id, 'question_id' => $questionId],
                    ['question_option_id' => $optionId]
                );
            }
        });

        $interestProfileService->computeForUser($request->user());

        return redirect()->route('interest-profile.show')
            ->with('status', 'Cuestionario completado. Aquí está tu perfil de intereses.');
    }
}
