<?php
namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Tests\TestCase;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\User;

class FormControllerTest extends TestCase implements Authenticatable
{
    use AuthenticableTrait;
    use DatabaseTransactions;

    public function setUp(): void {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    
    public function testGetFormAndFormQuestions()
    {
        $form = Form::create([
            'client_id' => 1,
            'code' => 'ABCDEFGHIJKLMN0123456789', // 0-9A-Zの24文字
            'status' => 1,
        ]);

        $formQuestion = FormQuestion::create([
            'form_id' => $form->id,
            'question' => 'Test Question?',
            'sort_order' => 1,
        ]);

        $response = $this->json('GET', '/api/forms/' . $form->code);

        // ステータスコードとレスポンスの構造を検証
        $response->assertStatus(200)
                 ->assertJson([
                    'form' => [
                        'id' => $form->id,
                        'client_id' => 1,
                        'code' => 'ABCDEFGHIJKLMN0123456789',
                        'status' => 1,
                    ],
                     'formQuestions' => [
                         [
                             'id' => $formQuestion->id,
                             'form_id' => $form->id,
                             'question' => 'Test Question?',
                             'sort_order' => 1,
                         ]
                     ]
                 ]);
    }

    public function testCreateFormSuccessfully()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/forms/create/1'); // NOTE: 1は仮のclientId

        $response->assertStatus(201)
                ->assertJson([
                    'message' => 'Form created successfully',
                ]);

        $this->assertDatabaseHas('forms', [
            'client_id' => 1,
            'status' => 1,
        ]);
    }

    // TODO: 外部DBからclientIdが取得できる様になってから追加
    // public function testCreateFormFailsWithInvalidClientId()
    // {
    //     $user = User::factory()->create();
    //     $invalidClientId = 999; // 存在しないID
    //     $response = $this->actingAs($user)->postJson('/api/forms/create/'.  $invalidClientId);
    //     $response->assertStatus(400)
    //             ->assertJson([
    //                 'message' => 'Invalid client ID',
    //             ]);
    // }

    public function testCreateFormFailsWithoutAuthentication()
    {
        $clientId = 1; // 仮のクライアントID
        $response = $this->postJson('/api/forms/create/'. $clientId);
        $response->assertStatus(401) // 未認証のステータスコード
                ->assertJson([
                    'message' => 'Unauthenticated.',
                ]);
    }
    
    public function testDestroyFormNotFound()
    {
        $notExistFormCode = 'ABCDEFGHIJKLMN0123456789'; // formを生成してないのでそもそもformが存在しない
        $response = $this->actingAs($this->user)->deleteJson('/api/forms/destroy/'. $notExistFormCode); // actingAsを使用してユーザーを認証
        $response->assertStatus(404)
                ->assertJson(['message' => 'Form not found']);
    }

    public function testDestroyFormSuccess()
    {
        // テスト用のフォームと質問を作成
        $testClientId = 1;
        $form = Form::create([
            'client_id' => $testClientId,
            'code' => 'ABCDEFGHIJKLMN0123456789',
            'status' => 1,
        ]);

        FormQuestion::create([
            'form_id' => $form->id,
            'question' => 'Test Question?',
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($this->user)->deleteJson("/api/forms/destroy/{$form->code}");

        $response->assertOk()
                 ->assertJson(['message' => 'Form deleted successfully']);

        // データベースからフォームと質問が削除されたことを確認
        $this->assertDatabaseMissing('forms', ['id' => $form->id]);
        $this->assertDatabaseMissing('form_questions', ['form_id' => $form->id]);
    }

    public function testUpdateFormNotFound()
    {
        $notExistFormCode = 'ABCDEFGHIJKLMN0123456789'; // formを生成してないのでそもそもformが存在しない
        $response = $this->actingAs($this->user)->putJson("/api/forms/update/{$notExistFormCode}", ['status' => 2]);
        $response->assertStatus(404)
                 ->assertJson(['message' => 'Form not found']);
    }

    public function testUpdateFormSuccess()
    {
        $tmpClientId = 1;
        // テスト用のフォームを作成
        $form = Form::create([
            'client_id' => $tmpClientId,
            'code' => 'ABCDEFGHIJKLMN0123456789',
            'status' => 1,
        ]);

        $newStatus = 2;
        $response = $this->actingAs($this->user)->putJson("/api/forms/update/{$form->code}", ['status' => $newStatus]);

        $response->assertOk()
                 ->assertJson([
                     'message' => 'Form status updated successfully',
                     'form' => [
                         'status' => $newStatus
                     ]
                 ]);

        // データベースでフォームのステータスが更新されたことを確認
        $this->assertDatabaseHas('forms', [
            'id' => $form->id,
            'status' => $newStatus
        ]);
    }
}
