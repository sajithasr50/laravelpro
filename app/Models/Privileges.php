<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Privileges extends Model
{
    use HasFactory;

    public static function viewFormById($id)
    {
        $getall = DB::table('privileges')
            ->select('privileges.*')
            ->where('privileges.userid', '=', $id)
            ->get();


        $result = $getall;
        $resultData = json_decode(json_encode($result), true);

        return $resultData;
    }
}
