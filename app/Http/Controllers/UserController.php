<?php

namespace App\Http\Controllers;

use App\Models\Privileges;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {

        return view('user.profile');
    }

    public function list()
    {

        $uploadedFiles = User::all();
        return view('user.list', compact('uploadedFiles'));
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    public function updatePrivilege(Request $request)
    {
        $priv = !empty($request->priv) ? json_encode($request->priv) : '';
        // print_r($request->userId);
        // die();

        Privileges::where('id', $request->id)->update(['privilege' => $priv]);


        return back()->with("statuspriv", "Privileges changed successfully!");
    }
    public function editprivilege(Request $request)
    {
        $getAll = Privileges::viewFormById($request->id);
        // print_r($getAll);
        // die();
        if (empty($getAll)) {
            return redirect()->to('/');
        }

        return view('user.privilege', compact('getAll'));


        //    $priv = !empty($request->priv)?json_encode($request->priv):'';

        //    $uploadedFile = new Privileges();
        //    $uploadedFile->exists = true;
        //    $uploadedFile->userid = auth()->user()->id; //already exists in database.
        //    $uploadedFile->privilege = $priv;
        //    $uploadedFile->save();

    }
}
