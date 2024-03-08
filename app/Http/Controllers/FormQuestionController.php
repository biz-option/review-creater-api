<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Http\Requests\FormQuestionRequest;
use App\Http\Requests\FormQuestionChangeSortOrderRequest;
use Hashids\Hashids;

class FormQuestionController extends Controller
{
    function create(FormQuestionRequest $request, String $formCode) {
        try {
            $form = Form::where('code', $formCode)->first();
            $formQuestions = FormQuestion::where('form_id', $form->id)->get();
            $formQuestion = new FormQuestion();
            $formQuestion->form_id = $form->id;
            $formQuestion->question = $request->input('question');
            $formQuestion->question_type = $request->input('question_type');
            $formQuestion->sort_order = count($formQuestions) + 1;
            $formQuestion->save();
            return response()->json(['message' => 'FormQuestion created successfully', 'form' => $form], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create formQuestion', 'error' => $e->getMessage()], 500);
        }
    }
    
    function destroy(Request $request, Integer $formQuestionId) {
        $formQuestion = FormQuestion::find('code', $formCode);
        if (!$formQuestion) {
            return response()->json(['message' => 'FormQuestion not found'], 404);
        }
        $formId = $formQuestion->form_id;
        $sortOrderToDelete = $formQuestion->sort_order;
        $formQuestion->delete();

        // 削除されたformQuestionの後に続くすべてのformQuestionsのsort_orderを更新します
        $followingFormQuestions = FormQuestion::where('form_id', $formId)
                                            ->where('sort_order', '>', $sortOrderToDelete)
                                            ->orderBy('sort_order', 'asc')
                                            ->get();

        foreach ($followingFormQuestions as $fq) {
            $fq->sort_order -= 1;
            $fq->save();
        }

        return response()->json(['message' => 'FormQuestion deleted successfully']);
    }
    
    function update(FormQuestionRequest $request, String $formQuestionId) {
        $formQuestion = FormQuestion::find($formQuestionId);
    
        if (!$formQuestion) {
            return response()->json(['message' => 'Form not found'], 404);
        }
        
        $formQuestion->question = $request->input('question');
        $formQuestion->question_type = $request->input('question_type');
        $formQuestion->question_part_texts = $request->input('question_part_texts');
        $formQuestion->save();
        
        return response()->json(['message' => 'FormQuestion status updated successfully', 'form' => $formQuestion]);
    }

    function changeSortOrder(FormQuestionChangeSortOrderRequest $request, String $formQuestionId) {
        $direction = $request->input('direction'); // 'up' または 'down'
        $formQuestion = FormQuestion::find($formQuestionId);

        if (!$formQuestion) {
            return response()->json(['message' => 'FormQuestion not found'], 404);
        }

        $currentSortOrder = $formQuestion->sort_order;
        $targetSortOrder = $direction === 'up' ? $currentSortOrder - 1 : $currentSortOrder + 1;

        // 対象のsortOrderを持つFormQuestionを検索
        $targetFormQuestion = FormQuestion::where('form_id', $formQuestion->form_id)
                                        ->where('sort_order', $targetSortOrder)
                                        ->first();

        if (!$targetFormQuestion) {
            return response()->json(['message' => 'Target FormQuestion for reorder not found'], 404);
        }

        // sortOrderの交換
        $formQuestion->sort_order = $targetSortOrder;
        $targetFormQuestion->sort_order = $currentSortOrder;

        $formQuestion->save();
        $targetFormQuestion->save();

        return response()->json(['message' => 'FormQuestion sortOrder updated successfully']);
    }
}

