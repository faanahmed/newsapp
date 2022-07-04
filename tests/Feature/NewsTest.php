<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use WithFaker;

    /**
     * A feature test to get news based on id
     *
     * @return void
     */
    public function test_get_news()
    {
        $this->get('news')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'content',
                    'user_id',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }


    /**
     * A feature test to store news
     *
     * @return void
     */
    public function test_for_add_news()
    {
        $newsPayload = [
            'title' => $this->faker->name(),
            'content' => $this->faker->text(),
            'user_id' => User::all()->random()->id,
        ];

        $response = $this->postJson('news', $newsPayload);

        $response->assertStatus(200);
    }

    /**
     * A feature test to delete news
     *
     * @return void
     */
    public function test_for_delete_news()
    {
        $response = $this->delete('news/'.News::all()->random()->id);

        $response->assertStatus(200);
    }
}
