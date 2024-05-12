<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Likes;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class DatorController extends Controller
{
    public function login_register_user(Request $request)
    {
        if ($request->has(['email', 'password'])) {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    return response()->json(['id' => $user->id]);
                } else {
                    return response()->json(['error' => 'Неправильний пароль.'], 401);
                }
            } else {
                $newUser = new User();
                $newUser->email = $request->email;
                $newUser->password = bcrypt($request->password);
                $newUser->save();

                return response()->json(['id' => $newUser->id], 201);
            }
        } else {
            return response()->json(['error' => 'Введіть електронну пошту та пароль для перевірки.'], 400);
        }
    }

    public function update_user(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Користувача не знайдено.'], 404);
        }
        $data = $request->only(['email','password']);
        $user->update($data);

        return response()->json(['id' => $user->id]);
    }
    public function create_profile(Request $request, $id)
    {
        $imageString = $request->input('photo');

        // Decode image into binary type
        $imageData = base64_decode($imageString);

        $data = $request->only(['user_id','name', 'age', 'gender', 'phone', 'search_purpose', 'city', 'hobbies']);

        $data = array_map(function($value) {
            return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        }, $data);

        $profile = new Profile();
        $profile->user_id = $data['user_id'];
        $profile->name = $data['name'];
        $profile->age = $data['age'];
        $profile->gender = $data['gender'];
        $profile->phone = $data['phone'];
        $profile->search_purpose = $data['search_purpose'];
        $profile->city = $data['city'];
        $profile->hobbies = $data['hobbies'];
        $profile->photo = $imageData;

        $profile->save();

        return response()->json(['Success' => 'Профіль створено.'], 201);
    }

    public function get_user_info($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Користувача не знайдено.'], 404);
        }
        $profile = $user->profile;
        if (!$profile) {
            return response()->json(['error' => 'Профіль користувача не знайдено.'], 404);
        }

        return response()->json([
            'id' => $user->id,
            'name' => $profile->name,
            'age' => $profile->age,
            'photo' => base64_encode($profile->photo),
            'gender' => $profile->gender,
            'phone' => $profile->phone,
            'search_purpose' => $profile->search_purpose,
            'city' => $profile->city,
            'hobbies' => $profile->hobbies,
        ]);
    }

    public function update_profile(Request $request, $id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['error' => 'Профіль не знайдено'], 404);
        }

        $imageString = $request->input('photo');
        if ($imageString) {
            // Decode into binary code
            $imageData = base64_decode($imageString);
            $request->merge(['photo' => $imageData]);
        }

        $data = $request->only(['user_id','name', 'age', 'gender', 'phone', 'search_purpose', 'city', 'hobbies']);
        $profile->update($data);

        return response()->json($profile);
    }

    public function create_membership(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Користувача не знайдено'], 404);
        }
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

    public function get_profiles()
    {
        $current_user_id = Auth::id();

        // Choose 2 random profiles
        $random_profiles = Profile::inRandomOrder()
            ->where('user_id', '<>', $current_user_id)
            ->limit(2)
            ->get();

        // Check if there is any profiles
        if ($random_profiles->isEmpty()) {
            return response()->json(['error' => 'Профілі не знайдено.'], 404);
        }

        $profiles_data = [];
        foreach ($random_profiles as $profile) {
            $profiles_data[] = [
                'id' => $profile->id,
                'name' => $profile->name,
                'age' => $profile->age,
                'photo' => base64_encode($profile->photo),
                'gender' => $profile->gender,
                'phone' => $profile->phone,
                'search_purpose' => $profile->search_purpose,
                'city' => $profile->city,
                'hobbies' => $profile->hobbies,
            ];
        }

        return response()->json($profiles_data);
    }

    public function request_like_profile(Request $request, $profile_id)
    {
        $profile = Profile::find($profile_id);
        // Check if profile exists
        if (!$profile) {
            return response()->json(['error' => 'Профіль не знайдено.'], 404);
        }
        // Check if ids is inputed
        if (!$request->has(['user_liked_id', 'liked_user_id'])) {
            return response()->json(['error' => 'Не вказані ідентифікатори користувачів.'], 400);
        }

        $user_liked_id = $request->input('user_liked_id');
        $liked_user_id = $request->input('liked_user_id');

        // Check if likes is mutual
        $existing_like = Likes::where('user_liked_id', $liked_user_id)
                            ->where('liked_user_id', $user_liked_id)
                            ->first();

        $like = new Likes();
        $like->user_liked_id = $user_liked_id;
        $like->liked_user_id = $liked_user_id;

        if ($existing_like) {
            $like->is_matched_likes = true;
            $existing_like->is_matched_likes = true;
            $existing_like->save();
        } else {
            $like->is_matched_likes = false;
        }

        $like->save();

        return response()->json(['success' => 'Профіль лайкнуто.']);
    }

    public function get_mutual_likes($user_id)
    {
        // Get all mutual likes for chosen user
        $mutual_likes = Likes::where('user_liked_id', $user_id)
                            ->where('is_matched_likes', true)
                            ->get();

        if ($mutual_likes->isEmpty()) {
            return response()->json(['error' => 'Взаємні лайки не знайдено.'], 404);
        }

        // Create list of users with mutual likes
        $users_data = [];
        foreach ($mutual_likes as $like) {
            $users_data[] = [
                'user_id' => $like->liked_user_id,
            ];
        }
        return response()->json($users_data);
    }
}
