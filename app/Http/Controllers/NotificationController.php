<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications();
     
        $notifications = $notifications->orderBy('created_at', 'desc')->paginate(3);
        $lastPage = $notifications->lastPage();
        if ($request->ajax()) {
            if ((int) $request->page <= $lastPage) {
                $notifications = $notifications;
                return view('user.notifications.list', compact('notifications'));
            } else {
                return response()->json(['message' => 'No more records', 'status' => true], 200);
            }
        }

        return abort(404);
    }

    public function markAsAllRead(Request $request)
    {
        $unreadNotifications = $request->user()->unreadNotifications;

        if ($unreadNotifications->count() > 0) {
            $unreadNotifications->markAsRead();
            return response()->json(['message' => 'Notifications marked as read'], 200);
        } else {
            return response()->json(['message' => 'All notifications already marked as read'], 200);
        }
    }

    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('notification_id');
        $notification = $request->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
            if (isset($notification->data['link'])) {
                return redirect($notification->data['link']);
            }
        } else {
            return redirect()->back()->with('error', 'Notification not found');
        }
    }
}
