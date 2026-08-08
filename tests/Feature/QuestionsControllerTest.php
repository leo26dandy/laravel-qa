<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class QuestionsControllerTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(): User
    {
        return User::create([
            'name' => 'Alice',
            'email' => 'alice@example.test',
            'password' => Hash::make('secret'),
        ]);
    }

    private function makeQuestion(User $user, array $overrides = []): Question
    {
        return $user->questions()->create(array_merge([
            'title' => 'How do I upgrade Laravel',
            'body' => 'Step by step, one major at a time.',
        ], $overrides));
    }

    public function test_guest_can_view_index()
    {
        $response = $this->get('/questions');
        $response->assertStatus(200);
    }

    public function test_index_lists_existing_questions()
    {
        $user = $this->makeUser();
        $this->makeQuestion($user, ['title' => 'Unique title marker']);

        $response = $this->get('/questions');
        $response->assertStatus(200);
        $response->assertSee('Unique title marker');
    }

    public function test_guest_can_view_create_form()
    {
        // Current app has NO auth middleware on QuestionsController.
        // Store would crash for a guest (calls $request->user()->questions()),
        // but the form itself is public. Encoding actual behavior for the
        // upgrade regression net; auth-guarding is out of scope here.
        $response = $this->get('/questions/create');
        $response->assertStatus(200);
    }

    public function test_authed_user_can_view_create_form()
    {
        $user = $this->makeUser();
        $response = $this->actingAs($user)->get('/questions/create');
        $response->assertStatus(200);
    }

    public function test_authed_user_can_store_question()
    {
        $user = $this->makeUser();
        $response = $this->actingAs($user)->post('/questions', [
            'title' => 'What is best PHP version',
            'body' => 'For Laravel 11 specifically.',
        ]);
        $response->assertRedirect('/questions');
        $this->assertDatabaseHas('questions', [
            'title' => 'What is best PHP version',
            'user_id' => $user->id,
        ]);
    }

    public function test_store_requires_title()
    {
        $user = $this->makeUser();
        $response = $this->actingAs($user)
            ->from('/questions/create')
            ->post('/questions', ['title' => '', 'body' => 'body text']);
        $response->assertRedirect('/questions/create');
        $response->assertSessionHasErrors('title');
    }

    public function test_store_requires_body()
    {
        $user = $this->makeUser();
        $response = $this->actingAs($user)
            ->from('/questions/create')
            ->post('/questions', ['title' => 'title text', 'body' => '']);
        $response->assertRedirect('/questions/create');
        $response->assertSessionHasErrors('body');
    }

    public function test_authed_user_can_view_edit_form()
    {
        $user = $this->makeUser();
        $question = $this->makeQuestion($user);
        $response = $this->actingAs($user)->get('/questions/' . $question->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_authed_user_can_update_question()
    {
        $user = $this->makeUser();
        $question = $this->makeQuestion($user);
        $response = $this->actingAs($user)->put('/questions/' . $question->id, [
            'title' => 'Updated title here',
            'body' => 'Updated body content',
        ]);
        $response->assertRedirect('/questions');
        $this->assertDatabaseHas('questions', [
            'id' => $question->id,
            'title' => 'Updated title here',
        ]);
    }

    public function test_authed_user_can_destroy_question()
    {
        $user = $this->makeUser();
        $question = $this->makeQuestion($user);
        $response = $this->actingAs($user)->delete('/questions/' . $question->id);
        $response->assertRedirect('/questions');
        $this->assertDatabaseMissing('questions', ['id' => $question->id]);
    }

    public function test_slug_auto_set_on_title()
    {
        $user = $this->makeUser();
        $question = $this->makeQuestion($user, ['title' => 'Hello World Slug Test']);
        $this->assertSame('hello-world-slug-test', $question->slug);
    }
}
