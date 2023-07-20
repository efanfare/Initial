<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Avatar;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::select('id', 'name', 'short_code')->get();
        $user = $request->user();

        return view('user.profile.index', compact('user', 'countries'));
    }

    public function view(Request $request)
    {

        return view('user.profile.view');
    }

    public function update(ProfileUpdateRequest $request, User $user)
    {
        $data = $request->all();
        $data['country_id'] = Country::where('short_code', $request->country_id)->first()->id ?? 229; //default USA
        $user->update($data);
        if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
            if (!$user->profile_image || $request->input('profile_image') !== $user->profile_image->file_name) {
                if ($user->profile_image) {
                    $user->profile_image->delete();
                }
                $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
            }
            sleep(3);
        }


        return redirect()->back()->with('message', 'Profile updated successfully');
    }

    public function ajaxGetUserDetail(Request $request)
    {

        $avatar = new Avatar();

        $user = User::find($request->id);
        $user->name =  $user->first_name . ' ' . $user->last_name;
        $user->image = ($user->profile_image ? $user->profile_image->thumbnail : $avatar->create($user->name)->setDimension(112, 112));
        // $user->image = $user->profile_image->thumbnail ?? $avatar->create($user->name)->setDimension(112, 112);
        $user->profile =  '<img src="' . $user->image . '" alt="image" class="img-fluid" width="40" />';
        $user->date = Carbon::createFromTimestamp($request->date)->diffForHumans();
        return response()->json(['message' => 'User Detail', 'user' => $user]);
    }
}
