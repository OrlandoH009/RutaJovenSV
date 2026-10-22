<?php

namespace Tests\Feature;

use App\Models\AcademicArea;
use App\Models\Career;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;

    public function test_toggling_a_career_saves_it_and_lists_it_in_favorites(): void
    {
        $area = AcademicArea::forceCreate(['name' => 'Tecnología', 'slug' => 'tecnologia']);
        $career = Career::forceCreate(['academic_area_id' => $area->id, 'name' => 'Software', 'slug' => 'software']);
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('favorites.careers.toggle', $career))
            ->assertOk()->assertJson(['saved' => true]);

        $this->get(route('dashboard'))->assertOk()->assertSee('Software');

        $this->get(route('favorites.index'))->assertOk()->assertSee('Software');

        $this->postJson(route('favorites.careers.toggle', $career))->assertJson(['saved' => false]);
        $this->assertDatabaseCount('saved_careers', 0);
    }
}
