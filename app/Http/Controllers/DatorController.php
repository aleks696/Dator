<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Likes;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatorController extends Controller
{
    public function create_user(Request $request)
    {
        if ($request->has(['name', 'password'])) {
            $user = User::where('name', $request->name)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return response()->json($user);
            } elseif (!$user) {
                $newUser = new User();
                $newUser->name = $request->name;
                $newUser->full_name = $request->full_name;
                $newUser->email = $request->email;
                $newUser->phone_number = $request->phone_number;
                $newUser->password = bcrypt($request->password);
                $newUser->save();

                return response()->json($newUser, 201);
            } else {
                return response()->json(['error' => 'Неправильний логін чи пароль.'], 401);
            }
        } else {
            return response()->json(['error' => 'Введіть ім\'я та пароль для перевірки.'], 400);
        }
    }

    public function update_user(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Користувача не знайдено.'], 404);
        }

        $data = $request->only(['name', 'full_name', 'email', 'phone_number', 'password']);
        $user->update($data);

        return response()->json($user);
    }
    public function create_profile(Request $request)
    {
        $imageString = $request->input('image');

        // Decode image into binary type
        $imageData = base64_decode($imageString);

        $data = $request->only(['user_id', 'age', 'gender', 'city', 'about_info', 'hobbies']);

        $data = array_map(function($value) {
            return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        }, $data);

        $profile = new Profile();
        $profile->user_id = $data['user_id'];
        $profile->age = $data['age'];
        $profile->gender = $data['gender'];
        $profile->city = $data['city'];
        $profile->about_info = $data['about_info'];
        $profile->hobbies = $data['hobbies'];
        $profile->image = $imageData;

        $profile->save();

        return response()->json($profile);
    }

    public function update_profile(Request $request, $id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['error' => 'Профіль не знайдено'], 404);
        }

        $imageString = $request->input('image');
        if ($imageString) {
            // Decode into binary code
            $imageData = base64_decode($imageString);
            $request->merge(['image' => $imageData]);
        }

        $data = $request->only(['user_id', 'age', 'gender', 'city', 'about_info', 'hobbies']);
        $profile->update($data);

        return response()->json($profile);
    }

    public function create_membership(Request $request)
    {
        $data = $request->only(['user_id', 'membership', 'swipes_amount', 'start_date']);
        $membership = Membership::create($data);

        return response()->json($membership);
    }
    public function update_membership(Request $request, $id)
    {
        $membership = Membership::find($id);

        if (!$membership) {
            return response()->json(['error' => 'Підписки не знайдено.'], 404);
        }

        $data = $request->only(['user_id', 'membership', 'swipes_amount', 'start_date']);
        $membership->update($data);

        return response()->json($membership);
    }

    public function like_profile(Request $request, $profile_id)
    {
        $profile = Profile::find($profile_id);

        if (!$profile) {
            return response()->json(['error' => 'Профіль не знайдено.'], 404);
        }

        if (!$request->has(['user_liked_id', 'liked_user_id'])) {
            return response()->json(['error' => 'Не вказані ідентифікатори користувачів.'], 400);
        }

        $like = new Likes();
        $user_liked_id = $request->input('user_liked_id');
        $liked_user_id = $request->input('liked_user_id');
        $like->user_liked_id = $user_liked_id;
        $like->liked_user_id = $liked_user_id;
        $like->is_matched_likes = false;
        $like->save();

        $mutual_like = Likes::where('user_liked_id', $liked_user_id)
                            ->where('liked_user_id', $user_liked_id)
                            ->first();

        if ($mutual_like) {
            $mutual_like->is_matched_likes = true;
            $mutual_like->save();
        }

        return response()->json(['success' => 'Профіль лайкнуто.']);
    }
}
