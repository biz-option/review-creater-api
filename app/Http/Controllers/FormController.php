<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use App\Models\FormQuestion;
use Hashids\Hashids;

class FormController extends Controller
{
    function get(Request $request, String $formCode) {
        $form = Form::where('code', $formCode)->first();
        if(!$form) {
            return response()->json(['message' => 'Form not found'], 404);
        }
        $formQuestion = FormQuestion::where('form_id', $form->id)->orderBy('sort_order', 'asc')->get();

        return response()->json(['form' => $form, 'formQuestions' => $formQuestion], 200);
    }
    
    function create(Request $request, int $clientId) {
        try {
            $hashids = new Hashids('', 24, '0123456789ABCDEFGHIJKMLNOPQRSTUVWKYZ');
            $form = new Form();
            $form->client_id = $clientId;
            $form->code = $hashids->encode($clientId);;
            $form->status = 1;
            $form->save();
            return response()->json(['message' => 'Form created successfully', 'form' => $form], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create form', 'error' => $e->getMessage()], 500);
        }
    }
    
    function destroy(Request $request, String $formCode) {
        $form = Form::where('code', $formCode)->first();
        if (!$form) {
            return response()->json(['message' => 'Form not found'], 404);
        }
        FormQuestion::where('form_id', $form->id)->delete();
        $form->delete();
        return response()->json(['message' => 'Form deleted successfully']);
    }
    
    function update(Request $request, String $formCode) {
        $form = Form::where('code', $formCode)->first();
        if (!$form) {
            return response()->json(['message' => 'Form not found'], 404);
        }
        $form->status = $request->input('status');
        $form->save();
        return response()->json(['message' => 'Form status updated successfully', 'form' => $form]);
    }
}

