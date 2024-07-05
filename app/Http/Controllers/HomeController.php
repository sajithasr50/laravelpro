<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CreateForm;
use App\Models\UserForm;

class HomeController extends Controller
{
    public function index()
    {
        $userdata = [];
        if (Auth::check()) {
            $userdata['username'] = Auth::user()->username;
        }

        return view('home.index', compact('userdata'));
    }

    public function formShow(Request $request) {
        $getAll = CreateForm::viewFormById($request->id);
        if (empty($getAll)) {
            return redirect()->to('/');
        }

        return view('createform.show', compact('getAll'));
    }

    public function submission(Request $request) {
        $formid = $request->post('formid');
        $field = $request->post('field');
        $statusFlag = false;
        foreach($field as $k => $v){
            if(!empty($v))
            {
                $statusFlag = true;
            }
        }
        if(!$statusFlag) {
            return redirect()->route('home.formshow', ['id' => $formid])->withErrors(['please enter any of the fields']);

        }
        $uploadedFile = new UserForm();
        $uploadedFile->formid = $request->get('formid');
        $uploadedFile->field_param = !empty($request->get('field'))?json_encode($request->get('field')):'';
        $uploadedFile->save();
        return back()->with("status", "Form submitted successfully!");
       
    }
}
