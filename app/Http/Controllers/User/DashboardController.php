<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Scene;
use App\Models\SceneInvitation;
use App\Notifications\AlertNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {

        if (Session::has('invite_token')) {
            $inviteToken = Session::get('invite_token');
            $invite = SceneInvitation::where('token', $inviteToken)->first();


            if ($invite) {
                if (!$invite->is_accepted) {
                    Notification::send(
                        $invite->scene->user,
                        (new AlertNotification(
                            subject: 'Accepted Invitation',
                            description: "has accepted invitation to scene " .   $invite->scene->title,
                            link: route('scene.artboard', $invite->scene->id),
                            viaEmail: false,
                            actionLinkLabel: 'View Scene',
                            userAlertId: auth()->user()->id
                        )),
                    );
                }
                $invite->update(['is_accepted' => 1]);
                Session::forget('invite_token');
                return redirect()->route('scene.artboard', $invite->scene_id);
            }
        }

        $scenes = Scene::where('user_id', auth()->user()->id)
            ->latest()
            ->paginate(10);

        return view('user.dashboard', compact('scenes'));
    }
}
