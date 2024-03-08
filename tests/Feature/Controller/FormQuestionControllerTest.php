<?php
namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Tests\TestCase;
use App\Models\User;
use App\Models\Form;
use App\Models\FormQuestion;

class FormQuestionControllerTest extends TestCase implements Authenticatable
{
    use AuthenticableTrait;
    use DatabaseTransactions;

    public function setUp(): void {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    
    public function testCreateFormQuestionSuccessfully()
    {
        $form = Form::create([
            'client_id' => 1,
            'status' => 1,
            'code' => 'testTempDormCode'
        ]);

        $response = $this->actingAs($this->user)->postJson(route('api.form-question.create', ['formCode' => $form->code]), [
            'question' => 'What is your name?',
            'question_type' => 1,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'FormQuestion created successfully',
        ]);
        $this->assertDatabaseHas('form_questions', [
            'question' => 'What is your name?',
            'question_type' => 1,
        ]);
    }
    
    /**
     * 存在しないformCodeを指定した場合のテスト
     *
     * @return void
     */
    public function testCreateFormQuestionWithInvalidFormCode()
    {
        $response = $this->actingAs($this->user)->postJson(route('api.form-question.create', ['formCode' => 'invalidCode']), [
            'question' => 'What is your name?',
            'question_type' => 'text',
        ]);
        $response->assertStatus(500); // または適切なエラーコード
        $response->assertJson(['message' => 'Failed to create formQuestion']);
    }

    /**
     * 必須パラメータが欠けている場合のテスト
     *
     * @return void
     */
    public function testCreateFormQuestionWithMissingParameters()
    {
        $formCode = 'validFormCode'; // 事前に有効なformCodeを設定
        $response = $this->actingAs($this->user)->postJson(route('api.form-question.create', ['formCode' => $formCode]), [
            // 'question' パラメータを意図的に省略
            'question_type' => 'text',
        ]);
        $response->assertStatus(422);
        $response->assertJson(['message' => 'The given data was invalid.']);
    }

    /**
     * 認証されていないユーザーがアクセスした場合のテスト
     *
     * @return void
     */
    public function testCreateFormQuestionUnauthenticated()
    {
        $formCode = 'validFormCode'; // 事前に有効なformCodeを設定
        $response = $this->postJson(route('api.form-question.create', ['formCode' => $formCode]), [
            'question' => 'What is your name?',
            'question_type' => 'text',
        ]);
        $response->assertStatus(401); // 認証が必要なステータスコード
        $response->assertJson(['message' => 'Unauthenticated.']);
    }
}
