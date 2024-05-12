<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Like;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\User;

class DatorController extends Controller
{
    public function check_user(Request $request)
    {
        if ($request->has(['name', 'password'])) {
            $user = User::where('name', $request->name)
                        ->where('password', $request->password)
                        ->first();

            if ($user) {
                return response()->json($user);
            } else {
                return response()->json(['error' => 'Неправильний логін чи пароль.'], 401);
            }
        } else {
            return response()->json(['error' => 'Введіть ім\'я та пароль для перевірки.'], 400);
        }
    }

    public function create_user(Request $request)
    {
        $user = new User();
        $user->name=$request->name;
        $user->full_name=$request->full_name;
        $user->email=$request->email;
        $user->phone_number=$request->phone_number;
        $user->password=bcrypt($request->password);
        $user->save();

        return response()->json($user, 201);
    }
    // Update data for user
    public function update_user(Request $request, $name)
    {
        $user = User::find($name);

        if (!$user) {
            return response()->json(['error' => 'Користувача не знайдено.'], 404);
        }

        $data = $request->only(['name', 'full_name', 'email', 'phone_number', 'password']);
        $user->update($data);

        return response()->json($user);
    }
}
