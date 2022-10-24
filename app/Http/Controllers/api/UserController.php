<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function setImage(Request $req)
    {
        $data = $req->validate([
            'image' => 'required|mimes:jpg,png,jpeg',
        ]);

        if ($req->image) {
            $file_name = time() . '_' . $req->image->getClientOriginalName();
            $file_path = $req->file('image')->storeAs('images', $file_name, 'public');
            User::find(1)->update([
                'image' => $file_name
            ]);

            return response()->json([
                'status' => 200,
                'image' => $file_name,
            ]);
        }
    }
    public function getImage()
    {
        return response()->json([
            'status' => 200,
            'image' => User::find(1)->image
        ]);
    }
}
