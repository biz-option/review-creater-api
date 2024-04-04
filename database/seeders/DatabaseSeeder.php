<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $form01 = \App\Models\Form::factory()->create(['client_id' => 1]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form01->id,
            'question' => 'スタッフの対応はどうでしたか？',
            'review_format' => '[A]',
            'sort_order' => 1
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form01->id,
            'question' => 'お店の雰囲気はどうでしたか？',
            'question_type' => 3,
            'question_part_texts' => 'よかった,普通,悪い',
            'review_format' => 'お店の雰囲気は[A]です。',
            'sort_order' => 2
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form01->id,
            'question' => 'おいしかった料理はなんですか？(複数回答化)',
            'question_type' => 2,
            'question_part_texts' => '刺身,鍋,揚げ物,天ぷら,炒め物',
            'review_format' => 'おいしかった料理は[A]でした。',
            'sort_order' => 3
        ]);
    }
}
