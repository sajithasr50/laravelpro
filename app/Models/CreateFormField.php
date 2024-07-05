<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateFormField extends Model
{
    use HasFactory;

    public static function deleteCreateFormField($id)
    {

        DB::table('create_form_fields')->where('formid', '=', $id)->delete();
    }
}
