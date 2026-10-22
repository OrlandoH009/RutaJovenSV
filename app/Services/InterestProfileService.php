<?php

namespace App\Services;

use App\Models\InterestProfile;
use App\Models\User;

class InterestProfileService
{
    public function computeForUser(User $user): InterestProfile
    {
        $actual = array_fill_keys(array_keys(config('interests.labels')), 0);

        $answers = $user->answers()->with('option')->get();

        foreach ($answers as $answer) {
            foreach ($answer->option->interest_weights ?? [] as $key => $weight) {
                $actual[$key] = ($actual[$key] ?? 0) + $weight;
            }
        }

        // El eje con más puntos del usuario es 100%; los demás son proporcionales a él.
        $top = max($actual);

        $scores = [];

        foreach ($actual as $key => $points) {
            $scores[$key] = $top > 0 ? (int) round($points / $top * 100) : 0;
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
}
