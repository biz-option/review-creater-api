<?php
namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Tests\TestCase;
use App\Models\User;
use App\Models\Form;
use App\Models\FormQuestion;

class FormQuestionControllerUpdateTest extends TestCase implements Authenticatable
{
    use AuthenticableTrait;
    // use DatabaseTransactions;

    public function setUp(): void {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testUpdateSuccessfully() {
        $form = Form::factory(['client_id' => 1])->create();
        $formQuestion = FormQuestion::factory(['form_id' => $form->id, 'question' => 'question?', 'question_type' => 1])->create();
        $response = $this->actingAs($this->user)->putJson("/api/form-questions/update/{$formQuestion->id}", [
            'question' => 'Updated Question',
            'question_type' => 2,
            'question_part_texts' => ['Part 1', 'Part 2'],
        ]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'FormQuestion status updated successfully']);
        $this->assertDatabaseHas('form_questions', [
            'id' => $formQuestion->id,
            'question' => 'Updated Question',
            'question_type' => 2,
            'question_part_texts' => json_encode(['Part 1', 'Part 2']),
        ]);
    }

    public function testUpdateFailsWhenNotFound() {
        $nonExistentId = 9999; // 存在しないID
        $response = $this->actingAs($this->user)->putJson("/api/form-questions/update/{$nonExistentId}", [
            'question' => 'Updated Question',
        ]);

        $response->assertStatus(422);
        $response->assertJson(['message' => 'The given data was invalid.']);
    }
}
