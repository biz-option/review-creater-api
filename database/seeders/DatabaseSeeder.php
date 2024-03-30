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
            'sort_order' => 1
        ]);

        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form01->id,
            'question' => '美味しかった料理はなんですか？(複数回答化)',
            'question_type' => 2,
            'question_part_texts' => '刺身,鍋,揚げ物,天ぷら,炒め物',
            'sort_order' => 2
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form01->id,
            'question' => 'スタッフの対応はどうでしたか？',
            'question_type' => 3,
            'question_part_texts' => 'よかった,普通,悪い',
            'sort_order' => 3
        ]);
    }
}
