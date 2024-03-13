<?php
namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Tests\TestCase;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\Review;
use App\Models\User;

class ReviewControllerTest extends TestCase implements Authenticatable
{
    use AuthenticableTrait;
    use DatabaseTransactions;

    public function setUp(): void {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    
    public function testSaveSuccessfully()
    {
        $user = User::factory()->create();
        $form = Form::create([
            'code' => 'ABCDEFGHIJKLMN0123456789',
            'client_id' => 1,
            'status' => 1
        ]);

        $response = $this->actingAs($user)->json('POST', '/api/reviews/'. $form->code, [
            'questions' => ['What is your name?', 'How old are you?'],
            'answers' => ['John Doe', '30'],
        ]);

        $response->assertStatus(200)
                ->assertJson(['message' => 'Review successfully saved']);
        $this->assertDatabaseHas('reviews', [
            'client_id' => 1,
            'form_id' => $form->id,
        ]);
    }

    public function testReturns_error_when_form_code_does_not_exist()
    {
        $response = $this->json('POST', '/api/review', [
            'formCode' => 'invalidCode',
            'questions' => ['What is your name?'],
            'answers' => ['John Doe'],
        ]);
        $response->assertStatus(404); // Laravelが自動的にNotFoundExceptionを404レスポンスに変換することを想定
    }
}
