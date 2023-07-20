<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\InvitationMail;
use App\Models\Role;
use App\Models\Scene;
use App\Models\SceneInvitation;
use App\Models\User;
use App\Notifications\AlertNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SceneInvitationController extends Controller
{
    public function invite(Scene $scene)
    {
        $users = User::getHostUser()->except(Auth::id())->pluck('email', 'id');
        $invitedUsers = SceneInvitation::pluck('email', 'id');


        return view('user.scenes.invite', compact('scene', 'users', 'invitedUsers'));
    }

    public function process(Request $request)
    {
        $invitedUsers = SceneInvitation::pluck('email')
            ->where('scene_id', $request->sceneId)
            ->toArray();

        $scene = Scene::find($request->sceneId);

        if ($request->emails) {
            foreach ($request->emails as $email) {
                if (!in_array($email, $invitedUsers)) {
                    do {

                        $token = Str::random(16);
                    } //check if the token already exists and if it does, try again
                    while (SceneInvitation::where('token', $token)->first());

                    //create a new invite record
                    $invite = SceneInvitation::create([
                        'scene_id' => $request->sceneId,
                        'invitation_message' => $request->message,
                        'email' => $email,
                        'token' => $token,
                        'is_accepted' => 0
                    ]);
                    
                    Mail::to($email)->send(new InvitationMail($invite));
                }
            }

            return response()->json([
                'message' => 'You have inivted people successfully!',
            ]);
        } else {
            return response()->json(['message' => '', 'errors' => 'At least one user is invited'], 422);
        }
    }

    public function accept($token)
    {
        // Look up the invite
        $invite = SceneInvitation::where('token', $token)->first();
        if (!$invite) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        $user = User::where('email', $invite->email)->first();

        if ($user) {
            if (Auth::check()) {
                if (!$invite->is_accepted) {
                    Notification::send(
                        $invite->scene->user,
                        (new AlertNotification(
                            subject: 'Accepted Invitation',
                            description: "has accepted invitation to scene " .   $invite->scene->title,
                            link: route('scene.artboard', $invite->scene->id),
                            viaEmail: false,
                            actionLinkLabel: 'View Scene',
                            userAlertId: $user->id
                        )),
                    );
                    $invite->update(['is_accepted' => 1]);
                }
                return redirect()->route('scene.artboard', $invite->scene_id);
            } else {
                Session::put('invite_token', $token);
                return redirect()->route('login');
            }
        } else {
            Session::put('invite_token', $token);
            return redirect()->route('user.signup');
        }
    }

    private function convertCanvasToImage($canvasData)
    {
        // Create an image instance from the canvas data
        $image = Image::make($canvasData);

        // Convert the image to binary data
        $binaryData = $image->encode('data-url')->encoded;

        return $binaryData;
    }

    // public function searchUser(Request $request)
    // {
    //     $users = User::where('email', 'like', '%' . $request->input('query') . '%')->get();

    //     $data = [];
    //     foreach ($users as $user) {
    //         $data[] = [
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'image' => 'http://localhost:8000/images/za2.png',
    //         ];
    //     }

    //     return response()->json([
    //         'users' => $data,
    //     ]);
    // }


    public function searchUser(Request $request)
    {

        $user = User::where('email', $request->input('query'))->first();
        $emails[] =  $request->input('query');

        $avatar = new Avatar();

        if ($user) {
            $user->name =  $user->first_name . ' ' . $user->last_name;
            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'image' => '<img width="35" src="' . ($user->profile_image ? $user->profile_image->thumbnail : $avatar->create($user->name)->setDimension(112, 112)) . '" alt="image" class="img-fluid">',
            ]);
        } else {
            return response()->json([
                'name' => 'anonymous',
                'email' => $request->input('query'),
                'image' => '<img width="35" src="' . $avatar->create(strtoupper($request->input('query')))->setDimension(112, 112)->setBackground('#' . substr(md5(rand()), 0, 6)) . '" alt="image" class="img-fluid">',
            ]);
        }
    }
}
