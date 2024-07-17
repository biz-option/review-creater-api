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
        $form01 = \App\Models\Form::factory()->create([
            'name' => 'sample form name',
            'desc' => 'フォーム上に入れる案内文を入れる',
            'client_id' => 1,
            'intro' => '',
            'keyword' => ''
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form01->id, 'sort_order' => 1,
            'question' => 'スタッフの対応はどうでしたか？',
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form01->id, 'sort_order' => 2, 'question_type' => 3,
            'question' => 'お店の雰囲気はどうでしたか？', 'question_part_texts' => 'よかった,普通,悪い',
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form01->id, 'sort_order' => 3, 'question_type' => 2,
            'question' => 'おいしかった料理はなんですか？(複数回答化)',
            'question_part_texts' => '刺身,鍋,揚げ物,天ぷら,炒め物',
        ]);

        $form02 = \App\Models\Form::factory()->create([
            'name' => 'sample form name',
            'desc' => 'フォーム上に入れる案内文を入れる',
            'client_id' => 1,
            'intro' => '',
            'keyword' => ''
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 1,
            'question' => '来店日時',
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 2, 'question_type' => 3,
            'question' => '性別',
            'question_part_texts' => '無回答,女性,男性',
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 3, 'question_type' => 2,
            'question' => 'ご利用用途',
            'question_part_texts' => '誕生日,デート,特になし',
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 4, 'question_type' => 2,
            'question' => 'おいしかった料理はなんですか？(複数回答化)',
            'question_part_texts' => '刺身,鍋,揚げ物,天ぷら,炒め物',
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 5, 'question_type' => 3,
            'question' => '一番美味しかった料理はなんですか？', 'question_part_texts' => '刺身,鍋,揚げ物,天ぷら,炒め物',
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 6, 'question_type' => 3,
            'question' => 'お店は清潔でしたか？', 'question_part_texts' => '清潔だった,普通だった,気になる点があった',
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 7, 'question_type' => 3,
            'question' => '価格はどうでしたか？', 'question_part_texts' => '高い,普通,安い',
        ]);
    }
}
