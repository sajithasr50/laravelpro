<?php

namespace App\Http\Controllers;

use App\Models\CreateForm;
use App\Models\CreateFormField;
use App\Models\Privileges;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CreateFormController extends Controller
{
    public function store(Request $request): RedirectResponse
    {

        $arrayvalid = [];
        $name = $request->post('name');
        $labelrow = $request->post('field')[0]['label'];
        $sfieldrow = $request->post('field')[0]['sample_field'];
        $fieldtyperow = $request->post('field')[0]['field_type'];
        $commentsrow = $request->post('field')[0]['comments'][0];
        if (empty($name)) {
            array_push($arrayvalid, 'name is required');
        }
        if (empty($labelrow)) {
            array_push($arrayvalid, 'label is required');
        }
        if (empty($sfieldrow)) {
            array_push($arrayvalid, 'sample field is required');
        }

        if (empty($fieldtyperow) && $fieldtyperow <= 0) {
            array_push($arrayvalid, 'field type is required');
        }
        if (in_array($fieldtyperow, [4, 5, 6])) {
            if (empty($commentsrow)) {
                $_POST['field[0][comments]'] = "";
            }
            array_push($arrayvalid, 'comment is required');
        }

        $statusFlag = true;
        $messages = '';

        if (!empty($arrayvalid)) {
            return redirect()->route('createform.create')
                ->withErrors($arrayvalid);
        }

        // $request->validate($arrayvalid);
        $fields = $request->post('field');


        if (!empty($fields)) {
            for ($i = 1; $i < count($fields); $i++) {
                $field_type = $fields[$i]['field_type'] ?? '';
                if (empty($fields[$i]['label'])) {
                    $messages .=  '<p>In label details is required in the row-' . ($i + 1) . '</p>';
                    // die();
                    $statusFlag = false;
                }
                if (empty($fields[$i]['sample_field'])) {
                    $messages .=  '<p>In Sample field details is required in the row-' . ($i + 1) . '</p>';
                    // die();
                    $statusFlag = false;
                }
                if (empty($fields[$i]['field_type'])) {
                    $messages .=  '<p>In field Type details is required in the row-' . ($i + 1) . '</p>';

                    $statusFlag = false;
                }
                if (in_array($field_type, [4, 5, 6])) {
                    if (empty($fields[$i]['comments'][0])) {
                        $messages .=  '<p>In Comments are required in the row-' . ($i + 1) . '</p>';

                        $statusFlag = false;
                    }
                }
            }
        }

        if ($statusFlag == false) {
            return redirect()->route('createform.create')
                ->withErrors($messages);
        }


        // Store file information in the database
        $uploadedFile = new CreateForm();
        $uploadedFile->name = $request->get('name');
        $uploadedFile->save();
        $getId = $uploadedFile->id;

        if (!empty($fields)) {
            for ($i = 0; $i < count($fields); $i++) {
                $field_type = $fields[$i]['field_type'] ?? '';
                $label = $fields[$i]['label'] ?? '';
                $sample_field = $fields[$i]['sample_field'] ?? '';
                $comments = $fields[$i]['comments'] ?? '';
                $jsoncomments = json_encode($comments);
                $cForm = new CreateFormField();
                $cForm->formid = $getId;
                $cForm->field_type = $field_type;
                $cForm->label = $label;
                $cForm->sample_field = $sample_field;
                $cForm->comments = $jsoncomments;

                $cForm->save();
            }
        }
        CustController::mailSent(auth()->user()->email);
        // Redirect back to the index page with a success message
        return redirect()->route('createform.index')
            ->with('success', "New CreateForm Added successfully.");
    }

    // shows the create form
    public function create()
    {
        return view('createform.create');
    }

    // shows the uploads index
    public function index()
    {
        $uploadedFiles = CreateForm::all();
        $privilegearr = Privileges::where(['userid' => auth()->user()->id])->first()->privilege;

        return view('createform.index', compact('uploadedFiles', 'privilegearr'));
    }
    public function delete(Request $request)
    {
        CreateForm::deleteCreateForm($request->id);
        $uploadedFiles = CreateForm::all();
        return view('createform.index', compact('uploadedFiles'));
    }

    public function showform(Request $request)
    {

        $getAll = CreateForm::viewFormById($request->id);
        if (empty($getAll)) {
            return redirect()->to('/');
        }

        return view('createform.show', compact('getAll'));
    }

    public function edit(Request $request)
    {

        $getAll = CreateForm::viewFormById($request->id);
        if (empty($getAll)) {
            return redirect()->to('/');
        }

        return view('createform.edit', compact('getAll'));
    }

    public function update(Request $request): RedirectResponse
    {

        $arrayvalid = [];
        $name = $request->post('name');
        $formId = $request->post('formId');
        $labelrow = $request->post('field')[0]['label'];
        $sfieldrow = $request->post('field')[0]['sample_field'];
        $fieldtyperow = $request->post('field')[0]['field_type'];
        $commentsrow = $request->post('field')[0]['comments'][0];
        if (empty($name)) {
            array_push($arrayvalid, 'name is required');
        }
        if (empty($labelrow)) {
            array_push($arrayvalid, 'label is required');
        }
        if (empty($sfieldrow)) {
            array_push($arrayvalid, 'sample field is required');
        }

        if (empty($fieldtyperow) && $fieldtyperow <= 0) {
            array_push($arrayvalid, 'field type is required');
        }
        if (in_array($fieldtyperow, [4, 5, 6])) {
            if (empty($commentsrow)) {
                $_POST['field[0][comments]'] = "";
            }
            array_push($arrayvalid, 'comment is required');
        }

        $statusFlag = true;
        $messages = [];

        if (!empty($arrayvalid)) {
            return redirect()->route('createform.edit', ['id' => $formId])->withErrors($arrayvalid);
        }

        // $request->validate($arrayvalid);
        $fields = $request->post('field');


        if (!empty($fields)) {
            for ($i = 1; $i < count($fields); $i++) {
                $field_type = $fields[$i]['field_type'] ?? '';
                if (empty($fields[$i]['label'])) {
                    array_push($messages, 'label details is required in the row-' . ($i + 1));
                    // die();
                    $statusFlag = false;
                }
                if (empty($fields[$i]['sample_field'])) {
                    array_push($messages, 'Sample field details is required in the row-' . ($i + 1));

                    // die();
                    $statusFlag = false;
                }
                if (empty($fields[$i]['field_type'])) {
                    array_push($messages, 'field Type details is required in the row-' . ($i + 1));


                    $statusFlag = false;
                }
                if (in_array($field_type, [4, 5, 6])) {
                    if (empty($fields[$i]['comments'][0])) {
                        array_push($messages, 'Comments required in the row-' . ($i + 1));


                        $statusFlag = false;
                    }
                }
            }
        }

        if ($statusFlag == false) {
            return redirect()->route('createform.edit', ['id' => $formId])->withErrors($messages);
        }


        // Store file information in the database
        $uploadedFile = new CreateForm();
        $uploadedFile->exists = true;
        $uploadedFile->id = $formId; //already exists in database.
        $uploadedFile->name = $request->get('name');
        $uploadedFile->save();

        CreateFormField::deleteCreateFormField($formId);

        if (!empty($fields)) {
            for ($i = 0; $i < count($fields); $i++) {
                $field_type = $fields[$i]['field_type'] ?? '';
                $label = $fields[$i]['label'] ?? '';
                $sample_field = $fields[$i]['sample_field'] ?? '';
                $comments = $fields[$i]['comments'] ?? '';
                $jsoncomments = json_encode($comments);
                $cForm = new CreateFormField();
                $cForm->formid = $formId;
                $cForm->field_type = $field_type;
                $cForm->label = $label;
                $cForm->sample_field = $sample_field;
                $cForm->comments = $jsoncomments;

                $cForm->save();
            }
        }


        // Redirect back to the index page with a success message
        return redirect()->route('createform.index')
            ->with('success', "Form Updated successfully.");
    }
}
