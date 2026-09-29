<?php

namespace App\Services;

use App\Models\InterestProfile;
use App\Models\Question;
use App\Models\User;

class InterestProfileService
{
    public function computeForUser(User $user): InterestProfile
    {
        $maxPossible = $this->maxPossibleScores();

        $actual = array_fill_keys(array_keys($maxPossible), 0);

        $answers = $user->answers()->with('option')->get();

        foreach ($answers as $answer) {
            foreach ($answer->option->interest_weights ?? [] as $key => $weight) {
                $actual[$key] = ($actual[$key] ?? 0) + $weight;
            }
        }

        $scores = [];

        foreach ($maxPossible as $key => $max) {
            $scores[$key] = $max > 0 ? (int) round(min($actual[$key] ?? 0, $max) / $max * 100) : 0;
        }

        arsort($scores);

        return InterestProfile::updateOrCreate(
            ['user_id' => $user->id],
            ['scores' => $scores, 'computed_at' => now()]
        );
    }

    public function explanationFor(InterestProfile $profile): string
    {
        $labels = config('interests.labels');

        $topKeys = collect($profile->scores)
            ->filter(fn ($score) => $score > 0)
            ->sortDesc()
            ->take(3)
            ->keys()
            ->map(fn ($key) => $labels[$key] ?? $key)
            ->values();

        if ($topKeys->isEmpty()) {
            return 'Aún no tienes suficientes respuestas para mostrar un perfil de intereses. Completa el cuestionario para ver tus resultados.';
        }

        if ($topKeys->count() === 1) {
            return "Según tus respuestas, tienes mayor afinidad con actividades relacionadas con {$topKeys[0]}.";
        }

        $last = $topKeys->pop();
        $rest = $topKeys->implode(', ');

        return "Según tus respuestas, tienes mayor afinidad con actividades relacionadas con {$rest} y {$last}. Esto es solo un punto de partida para explorar opciones, no una decisión tomada por ti.";
    }

    /**
     * Máximo puntaje posible por eje de interés, sumando el mejor puntaje
     * que cada pregunta puede aportar a ese eje (una opción por pregunta).
     */
    private function maxPossibleScores(): array
    {
        $labels = array_keys(config('interests.labels'));
        $max = array_fill_keys($labels, 0);

        $questions = Question::with('options')->get();

        foreach ($questions as $question) {
            $bestPerKey = [];

            foreach ($question->options as $option) {
                foreach ($option->interest_weights ?? [] as $key => $weight) {
                    $bestPerKey[$key] = max($bestPerKey[$key] ?? 0, $weight);
                }
            }

            foreach ($bestPerKey as $key => $weight) {
                if (! array_key_exists($key, $max)) {
                    $max[$key] = 0;
                }

                $max[$key] += $weight;
            }
        }

        return $max;
    }
}
