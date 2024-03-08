<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use App\Models\Review;
use App\Models\ReviewDetail;

class ReviewController extends Controller
{
    function save(Request $request) {
        // try {
            $form = Form::where('code', $request->route('formCode'))->firstOrFail();
            $review = new Review();
            $review->client_id = $form->client_id;
            $review->form_id = $form->id;
            $review->save();
            foreach($request->input('questions') as $key => $question) {
                    $detail = new ReviewDetail();
                    $detail->review_id = $review->id;
                    $detail->question = $question;
                    if (isset($request->input('answers')[$key])) { // answerが存在するか確認
                        $detail->answer = $request->input('answers')[$key];
                    }
                    $detail->save();
            }
            var_dump('3 foreachd');
            return response()->json(['message' => 'Review successfully saved']);
        // } catch (\Exception $e) {
        //     \Log::error('Review save failed: ' . $e->getMessage() . ', Request: ' . json_encode($request->all()));
        //     // エラーが発生してもユーザーには通知しないため、ここでは何も返さない
        //     return response()->json(['message' => 'An error occurred'], 500);
        // }
    }
}

