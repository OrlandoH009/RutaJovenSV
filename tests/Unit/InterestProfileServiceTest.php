<?php

namespace Tests\Unit;

use App\Models\Question;
use App\Models\User;
use App\Services\InterestProfileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterestProfileServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_normalizes_scores_to_100_when_user_maxes_out_an_axis(): void
    {
        $question = Question::create(['text' => '¿Pregunta?', 'order' => 1]);
        $techOption = $question->options()->create(['text' => 'Opción A', 'interest_weights' => ['technology' => 10], 'order' => 1]);
        $question->options()->create(['text' => 'Opción B', 'interest_weights' => ['health' => 10], 'order' => 2]);

        $user = User::factory()->create();
        $user->answers()->create([
            'question_id' => $question->id,
            'question_option_id' => $techOption->id,
        ]);

        $profile = (new InterestProfileService)->computeForUser($user);

        $this->assertSame(100, $profile->scores['technology']);
        $this->assertSame(0, $profile->scores['health']);
    }

    public function test_explanation_mentions_top_interest_when_profile_has_scores(): void
    {
        $question = Question::create(['text' => '¿Pregunta?', 'order' => 1]);
        $option = $question->options()->create(['text' => 'Opción A', 'interest_weights' => ['creativity' => 10], 'order' => 1]);

        $user = User::factory()->create();
        $user->answers()->create([
            'question_id' => $question->id,
            'question_option_id' => $option->id,
        ]);

        $service = new InterestProfileService;
        $profile = $service->computeForUser($user);

        $this->assertStringContainsString('Creatividad', $service->explanationFor($profile));
    }
}
