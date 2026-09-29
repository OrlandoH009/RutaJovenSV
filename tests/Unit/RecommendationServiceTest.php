<?php

namespace Tests\Unit;

use App\Models\AcademicArea;
use App\Models\Career;
use App\Models\InterestProfile;
use App\Models\User;
use App\Services\RecommendationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecommendationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_ranks_careers_by_similarity_to_the_user_profile(): void
    {
        $area = AcademicArea::create(['name' => 'Tecnología', 'slug' => 'tecnologia']);

        $matching = Career::create(['academic_area_id' => $area->id, 'name' => 'Desarrollo de Software', 'slug' => 'desarrollo-de-software']);
        $matching->interestWeights()->create(['interest_key' => 'technology', 'weight' => 90]);

        $unrelated = Career::create(['academic_area_id' => $area->id, 'name' => 'Enfermería', 'slug' => 'enfermeria']);
        $unrelated->interestWeights()->create(['interest_key' => 'health', 'weight' => 90]);

        $user = User::factory()->create();
        $profile = InterestProfile::create([
            'user_id' => $user->id,
            'scores' => ['technology' => 90, 'health' => 0],
            'computed_at' => now(),
        ]);

        $results = (new RecommendationService)->relatedCareers($profile, limit: 5);

        $this->assertSame('Desarrollo de Software', $results->first()->name);
        $this->assertFalse($results->contains('name', 'Enfermería'));
    }
}
