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
            'keyword' => '',
            'is_ai' => false
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form01->id, 'sort_order' => 1,
            'question' => 'スタッフの対応はどうでしたか？',
        ]);
        \App\Models\FormQuestion::factory()->create([
            'form_id' => $form01->id, 'sort_order' => 2, 'question_type' => 3,
            'question' => 'お店の雰囲気はどうでしたか？', 'question_part_texts' => 'よかった,普通,悪い',
        ]);

        $form02 = \App\Models\Form::factory()->create([
            'name' => 'ご来店アンケート',
            'desc' => '本日はご来店いただき誠にありがとうございました。',
            'client_id' => 1,
            'intro' => '',
            'keyword' => '',
            'is_ai' => true,
            'url1' => 'https://tabelog.com/tokyo/A1322/A132203/13287082/'
        ]);
        $form02_q_01 = \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 1, 'question_type' => 3,
            'question' => '当店にご訪問いただいたのは何回目ですか？',
            'question_part_texts' => '初めて,2回目,3回以上',
        ]);
        $form02_q_02 = \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 2, 'question_type' => 3,
            'question' => '性別',
            'question_part_texts' => '無回答,女性,男性',
        ]);
        $form02_q_03 = \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 3, 'question_type' => 3,
            'question' => 'ご利用用途',
            'question_part_texts' => '接待,誕生日,デート,特になし',
        ]);
        $form02_q_04 = \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 5, 'question_type' => 3,
            'question' => 'ご料理は満足いただけましたか？',
            'question_part_texts' => '大変満足,満足,やや満足,普通,少し不満,不満,かなり不満',
        ]);
        $form02_q_05 = \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 5, 'question_type' => 3,
            'question' => 'スタッフの対応はどうでしたか？',
            'question_part_texts' => 'とても良い,良い,普通,あまり良くない,悪い',
        ]);
        $form02_q_06 = \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 6, 'question_type' => 3,
            'question' => 'お店は清潔でしたか？',
            'question_part_texts' => '清潔だった,普通だった,気になる点があった',
        ]);
        $form02_q_07 = \App\Models\FormQuestion::factory()->create([
            'form_id' => $form02->id, 'sort_order' => 7, 'question_type' => 1,
            'question' => 'ご意見があればお聞かせください。'
        ]);

        $review_02_01 = \App\Models\Review::factory()->create(['form_id' => 2, 'created_at' => '2024-08-12 09:40:26',
            'message' => '初めて当店にご訪問いただいた女性のお客様からは、サービスや商品の満足度が高いとのコメントをたくさんいただきました。引き続きご利用いただけることを心から願っております。']);
        $review_02_02 = \App\Models\Review::factory()->create(['form_id' => 2, 'created_at' => '2024-08-12 09:40:26',
            'message' => 'デートで初めて利用しました。料理は満足で、スタッフの対応は良かったです。お店は普通だったが、サラダは美味しかったです。お刺身の匂いが気になりました。']);
        $review_02_03 = \App\Models\Review::factory()->create(['form_id' => 2, 'created_at' => '2024-08-12 09:40:26', 'message' => 'demo message']);
        $review_02_04 = \App\Models\Review::factory()->create(['form_id' => 2, 'created_at' => '2024-08-12 09:40:26', 'message' => 'demo message']);
        $review_02_05 = \App\Models\Review::factory()->create(['form_id' => 2, 'created_at' => '2024-08-12 09:40:26', 'message' => 'demo message']);
        $review_02_06 = \App\Models\Review::factory()->create(['form_id' => 2, 'created_at' => '2024-08-12 09:40:26', 'message' => 'demo message']);
        $review_02_07 = \App\Models\Review::factory()->create(['form_id' => 2, 'created_at' => '2024-08-12 09:40:26', 'message' => 'demo message']);
        $review_02_08 = \App\Models\Review::factory()->create(['form_id' => 2, 'created_at' => '2024-08-12 09:40:26', 'message' => 'demo message']);
        $review_02_09 = \App\Models\Review::factory()->create(['form_id' => 2, 'created_at' => '2024-08-12 09:40:26', 'message' => 'demo message']);
        $review_02_10 = \App\Models\Review::factory()->create(['form_id' => 2, 'created_at' => '2024-08-12 09:40:26', 'message' => 'demo message']);

        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_01->id, 'form_question_id' => $form02_q_01->id, 'answer' => '初めて', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_01->id, 'form_question_id' => $form02_q_02->id, 'answer' => '女性', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_01->id, 'form_question_id' => $form02_q_03->id, 'answer' => '接待', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_01->id, 'form_question_id' => $form02_q_04->id, 'answer' => '大変満足', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_01->id, 'form_question_id' => $form02_q_05->id, 'answer' => 'とても良い', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_01->id, 'form_question_id' => $form02_q_06->id, 'answer' => '清潔だった', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_01->id, 'form_question_id' => $form02_q_07->id, 'answer' => '美味しかったです。また来ます。', 'created_at' => '2024-08-12 09:40:26']);

        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_02->id, 'form_question_id' => $form02_q_01->id, 'answer' => '初めて', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_02->id, 'form_question_id' => $form02_q_02->id, 'answer' => '無回答', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_02->id, 'form_question_id' => $form02_q_03->id, 'answer' => 'デート', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_02->id, 'form_question_id' => $form02_q_04->id, 'answer' => '満足', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_02->id, 'form_question_id' => $form02_q_05->id, 'answer' => '良い', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_02->id, 'form_question_id' => $form02_q_06->id, 'answer' => '普通だった', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_02->id, 'form_question_id' => $form02_q_07->id, 'answer' => 'サラダが美味しかったです！お刺身は少し匂いがしました', 'created_at' => '2024-08-12 09:40:26']);

        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_03->id, 'form_question_id' => $form02_q_01->id, 'answer' => '初めて', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_03->id, 'form_question_id' => $form02_q_02->id, 'answer' => '無回答', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_03->id, 'form_question_id' => $form02_q_03->id, 'answer' => 'デート', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_03->id, 'form_question_id' => $form02_q_04->id, 'answer' => 'やや満足', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_03->id, 'form_question_id' => $form02_q_05->id, 'answer' => '良い', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_03->id, 'form_question_id' => $form02_q_06->id, 'answer' => '清潔だった', 'created_at' => '2024-08-12 09:40:26']);

        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_04->id, 'form_question_id' => $form02_q_01->id, 'answer' => '初めて', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_04->id, 'form_question_id' => $form02_q_02->id, 'answer' => '男性', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_04->id, 'form_question_id' => $form02_q_03->id, 'answer' => '特になし', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_04->id, 'form_question_id' => $form02_q_04->id, 'answer' => '普通', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_04->id, 'form_question_id' => $form02_q_05->id, 'answer' => 'とても良い', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_04->id, 'form_question_id' => $form02_q_06->id, 'answer' => '清潔だった', 'created_at' => '2024-08-12 09:40:26']);

        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_05->id, 'form_question_id' => $form02_q_01->id, 'answer' => '初めて', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_05->id, 'form_question_id' => $form02_q_02->id, 'answer' => '男性', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_05->id, 'form_question_id' => $form02_q_03->id, 'answer' => '特になし', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_05->id, 'form_question_id' => $form02_q_04->id, 'answer' => '少し不満', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_05->id, 'form_question_id' => $form02_q_05->id, 'answer' => '悪い', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_05->id, 'form_question_id' => $form02_q_06->id, 'answer' => '気になる点があった', 'created_at' => '2024-08-12 09:40:26']);

        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_06->id, 'form_question_id' => $form02_q_01->id, 'answer' => '初めて', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_06->id, 'form_question_id' => $form02_q_02->id, 'answer' => '男性', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_06->id, 'form_question_id' => $form02_q_03->id, 'answer' => '特になし', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_06->id, 'form_question_id' => $form02_q_04->id, 'answer' => '不満', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_06->id, 'form_question_id' => $form02_q_05->id, 'answer' => 'あまり良くない', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_06->id, 'form_question_id' => $form02_q_06->id, 'answer' => '普通だった', 'created_at' => '2024-08-12 09:40:26']);

        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_07->id, 'form_question_id' => $form02_q_01->id, 'answer' => '初めて', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_07->id, 'form_question_id' => $form02_q_02->id, 'answer' => '男性', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_07->id, 'form_question_id' => $form02_q_03->id, 'answer' => '特になし', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_07->id, 'form_question_id' => $form02_q_04->id, 'answer' => 'かなり不満', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_07->id, 'form_question_id' => $form02_q_05->id, 'answer' => 'とても良い', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_07->id, 'form_question_id' => $form02_q_06->id, 'answer' => '普通だった', 'created_at' => '2024-08-12 09:40:26']);

        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_08->id, 'form_question_id' => $form02_q_01->id, 'answer' => '2回目', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_08->id, 'form_question_id' => $form02_q_02->id, 'answer' => '男性', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_08->id, 'form_question_id' => $form02_q_03->id, 'answer' => '特になし', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_08->id, 'form_question_id' => $form02_q_04->id, 'answer' => 'やや満足', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_08->id, 'form_question_id' => $form02_q_05->id, 'answer' => 'とても良い', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_08->id, 'form_question_id' => $form02_q_06->id, 'answer' => '普通だった', 'created_at' => '2024-08-12 09:40:26']);

        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_09->id, 'form_question_id' => $form02_q_01->id, 'answer' => '2回目', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_09->id, 'form_question_id' => $form02_q_02->id, 'answer' => '女性', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_09->id, 'form_question_id' => $form02_q_03->id, 'answer' => '特になし', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_09->id, 'form_question_id' => $form02_q_04->id, 'answer' => 'やや満足', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_09->id, 'form_question_id' => $form02_q_05->id, 'answer' => '良い', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_09->id, 'form_question_id' => $form02_q_06->id, 'answer' => '普通だった', 'created_at' => '2024-08-12 09:40:26']);

        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_10->id, 'form_question_id' => $form02_q_01->id, 'answer' => '3回以上', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_10->id, 'form_question_id' => $form02_q_02->id, 'answer' => '無回答', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_10->id, 'form_question_id' => $form02_q_03->id, 'answer' => '特になし', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_10->id, 'form_question_id' => $form02_q_04->id, 'answer' => 'やや満足', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_10->id, 'form_question_id' => $form02_q_05->id, 'answer' => '良い', 'created_at' => '2024-08-12 09:40:26']);
        \App\Models\ReviewDetail::factory()->create(['review_id' => $review_02_10->id, 'form_question_id' => $form02_q_06->id, 'answer' => '普通だった', 'created_at' => '2024-08-12 09:40:26']);
    }
}
