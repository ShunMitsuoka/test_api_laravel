<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserApiController extends Controller
{
    public function show()
    {
        $user = User::where("name", "二階堂 真也")->first();

        return response()->json([
            "name" => $user->name,
            "birth" => $user->birth,
            "company" => $user->company,
            "department" => $user->department,
            "hobby" => $user->hobby,
            "recommended_restaurant	" => $user->recommended_restaurant,
            "favorite_place" => $user->favorite_place,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
