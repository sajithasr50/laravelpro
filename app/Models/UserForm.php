<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserForm extends Model
{
    use HasFactory;


    public static function viewFormById($id)
    {
        $getall = DB::table('create_forms')
            ->join('create_form_fields', 'create_form_fields.formid', '=', 'create_forms.id')
            ->select('create_forms.*', 'create_form_fields.*')
            ->where('create_forms.id', '=', $id)
            ->get();


        $result = $getall;
        $resultData = json_decode(json_encode($result), true);

        return $resultData;
    }

    public static function deleteCreateForm($id)
    {

        DB::table('create_forms')->where('id', '=', $id)->delete();
        DB::table('create_form_fields')->where('formid', '=', $id)->delete();
    }
}
