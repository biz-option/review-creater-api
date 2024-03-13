<?php
namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Tests\TestCase;
use App\Models\User;
use App\Models\Form;
use App\Models\FormQuestion;

class FormQuestionControllerChangeSortOrderTest extends TestCase implements Authenticatable
{
    use AuthenticableTrait;
    // use DatabaseTransactions;

    public function setUp(): void {
        parent::setUp();
        $this->user = User::factory()->create();
    }
        
    public function testChangeSortOrderUp()
    {
        $form = Form::factory()->create(['client_id' => 1]);
        $firstQuestion = FormQuestion::factory()->create(['form_id' => $form->id, 'question' => 'questionText', 'question_type' => 1, 'sort_order' => 1]);
        $secondQuestion = FormQuestion::factory()->create(['form_id' => $form->id, 'question' => 'questionText', 'question_type' => 1, 'sort_order' => 2]);
        $response = $this->actingAs($this->user)->postJson(route('api.form-question.change-sort-order', ['formQuestionId' => $secondQuestion->id]), [
            'direction' => 'up',
        ]);
        $response->assertStatus(200);
        $this->assertEquals(1, $secondQuestion->fresh()->sort_order);
        $this->assertEquals(2, $firstQuestion->fresh()->sort_order);
    }

    public function testChangeSortOrderDown()
    {
        $form = Form::factory()->create(['client_id' => 1]);
        $firstQuestion = FormQuestion::factory()->create(['form_id' => $form->id, 'question' => 'questionText', 'question_type' => 1, 'sort_order' => 1]);
        $secondQuestion = FormQuestion::factory()->create(['form_id' => $form->id, 'question' => 'questionText', 'question_type' => 1, 'sort_order' => 2]);
        $response = $this->actingAs($this->user)->postJson(route('api.form-question.change-sort-order', ['formQuestionId' => $firstQuestion->id]), [
            'direction' => 'down',
        ]);
        $response->assertStatus(200);
        $this->assertEquals(2, $firstQuestion->fresh()->sort_order);
        $this->assertEquals(1, $secondQuestion->fresh()->sort_order);
    }

    public function testChangeSortOrderWithInvalidSortOrder()
    {
        $form = Form::factory()->create(['client_id' => 1]);
        $firstQuestion = FormQuestion::factory()->create(['form_id' => $form->id, 'question' => 'questionText', 'question_type' => 1, 'sort_order' => 1]);
        $responseUp = $this->actingAs($this->user)->postJson(route('api.form-question.change-sort-order', ['formQuestionId' => $firstQuestion->id]), [
            'direction' => 'up',
        ]);
        $responseDown = $this->actingAs($this->user)->postJson(route('api.form-question.change-sort-order', ['formQuestionId' => $firstQuestion->id]), [
            'direction' => 'down',
        ]);
        $responseUp->assertStatus(404);
        $responseDown->assertStatus(404);
    }
}
