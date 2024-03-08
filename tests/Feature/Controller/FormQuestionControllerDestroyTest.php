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
}
