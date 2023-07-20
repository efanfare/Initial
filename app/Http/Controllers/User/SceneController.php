<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSceneRequest;
use App\Models\Background;
use App\Models\Item;
use App\Models\ItemChat;
use App\Models\ItemChatCaption;
use App\Models\ItemChatThread;
use App\Models\Package;
use App\Models\PhotoBank;
use Illuminate\Http\Request;
use App\Models\Scene;
use App\Models\SceneInvitation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PDF;


class SceneController extends Controller
{

    public function index(Request $request)
    {
        $scenes = Scene::where('user_id', auth()->user()->id)
            ->latest()
            ->paginate(10);
        $sharedWithYouScenes = SceneInvitation::where('email',  auth()->user()->email)
            ->where('is_accepted', 1)
            ->get();
        return view('user.scenes.index', compact('scenes', 'sharedWithYouScenes'));
    }

    public function create(Request $request)
    {
        if (!$this->sceneLimit()) {
            return redirect()->back()->with('error', 'You scene limit is reached. Kindly purchase any subcription plan to continue');
        }
        return view('user.scenes.create');
    }

    public function store(StoreSceneRequest $request)
    {
        if (!$this->sceneLimit()) {
            return redirect()->back()->with('error', 'You scene limit is reached. Kindly purchase any subcription plan to continue');
        }
        $scene =  new Scene;
        $scene->uuid = Str::uuid();
        $scene->title = $request->title;
        $scene->description = $request->description;
        $scene->user_id = $request->user()->id;
        $scene->save();

        return redirect()->route('scene.artboard', $scene);
    }

    public function artBoard(Scene $scene)
    {
        // Check if the user is invited to the scene or if they are the host
        $isInvited = SceneInvitation::where('scene_id', $scene->id)
            ->where('email', auth()->user()->email)
            ->exists();
        if ($isInvited) {
            $getInvitationUser = User::where('email', auth()->user()->email)
                ->first();
        }

        // dd($getInvitationUser->id);

        $isHost = $scene->user_id == auth()->user()->id;

        if (!$isInvited && !$isHost) {

            abort(403, 'You are not allowed to access this account.');
        }

        if ($scene->canvas_json === null) {
            $scene->canvas_json = 'null';
        }

        $items = Item::where('user_id', auth()->user()->id)->latest()->get();

        $backgrounds = Background::where('user_id', auth()->user()->id)
            ->orWhere('service_type', 'System')
            ->latest()
            ->get();


        $photoBanks = PhotoBank::with('item')
            // ->whereHas('item', function ($query) {
            // $query->where('user_id', auth()->user()->id)->withTrashed()
            //     ->orWhere('user_id', $getInvitationUser->id);
            // })
            ->where('scene_id', $scene->id)
            ->latest()
            ->get();

        $invitedUsers = SceneInvitation::where('scene_id',  $scene->id)->pluck('email', 'id')->toArray();

        $invitedUsersList = SceneInvitation::where('scene_id',  $scene->id)->get();

        return view('user.scenes.artboard', compact('scene', 'items', 'photoBanks', 'backgrounds', 'invitedUsers', 'invitedUsersList'));
    }

    public function update(Request $request, $id)
    {

        $scene  = Scene::find($id);

        if ($request->input('column') === 'title') {
            $scene->title = $request->input('value');
        }
        if ($request->input('column') === 'description') {
            $scene->description = $request->input('value');
        }
        if ($request->input('canvasJson')) {
            $scene->canvas_json = $request->input('canvasJson');
        }

        if ($request->input('backgroundId')) {
            $scene->backgorund_id = $request->input('backgroundId');
        }
        $scene->update();
        if ($request->input('canvasImage')) {
            $image = $request->input('canvasImage');
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(16) . '.png';
            // Delete previous image
            // $scene->clearMediaCollection('scene_canvas_image');

            // Store the image using Spatie Media Library
            $scene->addMediaFromString(base64_decode($image))
                ->usingFileName($imageName)
                ->toMediaCollection('scene_canvas_image');
        }

        return response()->json(['message' => 'Scene saved successfully']);
    }


    public function delete(Request $request, $scene)
    {

        $scene = Scene::find($scene);

        if ($scene->user_id !== auth()->user()->id) {
            abort(403, 'You do not have permission to access this scene.');
        }
        $scene->delete();
        return redirect()->back()->with('message', 'Scene deleted successfully');
    }


    public function ajaxItemThread(Request $request)
    {

        $itemChatThread = ItemChat::where('uuid', $request->uuid)->get();
        $itemChatCaption = ItemChatCaption::where('uuid', $request->uuid)->first();

        $uuid = $request->uuid;
        $itemId = str_replace('photoBank_', '', $request->itemId);
        $item = Item::withTrashed()->find($itemId);
        $user = User::find($request->userId);
        $date  = Carbon::createFromTimestamp($request->date)->diffForHumans();
        $isDeleted = filter_var($request->isDeleted, FILTER_VALIDATE_BOOLEAN);

        $html = view('user.scenes.item_chat', compact('itemChatThread', 'uuid', 'item', 'user', 'date', 'isDeleted', 'itemChatCaption'))->render();

        return response()->json([
            'message' => 'Successfully!',
            'html' => $html,
        ]);
    }

    public function ajaxItemFilterThread(Request $request)
    {

        $itemChatThread = ItemChat::where('uuid', $request->uuid)->orderBy('created_at', $request->order)->get();
        // dd($itemChatThread);
        $uuid =  $request->uuid;
        $html = view('user.scenes.item_chat_filter', compact('itemChatThread', 'uuid'))->render();

        return response()->json([
            'message' => 'Successfully!',
            'html' => $html,
        ]);
    }

    public function ajaxItemThreadUpdate(Request $request)
    {
        $uuid = $request->uuid;
        $textHtml = null;
        $imageChatHtml = null;

        if ($request->message || $request->id) {
            $validatorMessage = Validator::make($request->all(), [
                'message' => 'required|string|max:255',
            ], [
                'message.required' => 'Please enter a message',
                'message.string' => 'Invalid message format',
                'message.max' => 'Message should not exceed 255 characters',
            ]);

            if ($validatorMessage->fails()) {
                return response()->json([
                    'message' => '',
                    'errors' => $validatorMessage->errors(),
                ], 422);
            }
        }

        // if ($request->hasFile('chat_image') && $request->file('chat_image')->isValid()) {
        //     $validator = Validator::make($request->all(), [
        //         'chat_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     ], [
        //         'chat_image.required' => 'Please select an image',
        //         'chat_image.image' => 'Uploaded file format is not allowed. Try uploading an image in JPEG, PNG, or GIF format',
        //         'chat_image.mimes' => 'Uploaded file format is not allowed. Try uploading an image in JPEG, PNG, or GIF format',
        //         'chat_image.max' => 'File size should not exceed 2MB. Please try again',
        //     ]);

        //     if ($validator->fails()) {
        //         return response()->json([
        //             'message' => '',
        //             'errors' => $validator->errors(),
        //         ], 422);
        //     }
        // }


        if ($request->id) {
            $itemChatThreadMessage = ItemChat::find($request->id);
            $itemChatThreadMessage->title = $request->message;
            $itemChatThreadMessage->save();
        } else {
            if ($request->message) {
                $itemChatThreadMessage = ItemChat::create(
                    [
                        'uuid' => $request->uuid,
                        'title' =>  $request->message,
                        'user_id' => auth()->user()->id,
                        'scene_id' => $request->sceneId,
                        'item_id' => $request->itemId,
                        'type' => ItemChat::TYPETEXT,
                    ]
                );
                if ($request->hasFile('chat_image') && $request->file('chat_image')->isValid()) {
                    $itemChatThreadMessage->addMediaFromRequest('chat_image')->toMediaCollection('chat_image');
                }
                $textHtml = view('user.scenes.item_chat_new_message_append', compact('itemChatThreadMessage'))->render();
            }

            if ($request->hasFile('chat_image') && $request->file('chat_image')->isValid() && !$request->message) {
                $itemChatThreadImage = ItemChat::create(
                    [
                        'uuid' => $request->uuid,
                        'type' => ItemChat::TYPEPIC,
                        'user_id' => auth()->user()->id,
                        'scene_id' => $request->sceneId,
                        'item_id' => $request->itemId,
                    ]
                );
                $itemChatThreadImage->addMediaFromRequest('chat_image')->toMediaCollection('chat_image');
                $imageChatHtml = view('user.scenes.item_chat_new_image_append', compact('itemChatThreadImage'))->render();
            }
        }

        return response()->json([
            'message' => 'Successfully!',
            'textHtml' => $textHtml,
            'imageChatHtml' => $imageChatHtml,
        ]);
    }

    public function ajaxItemThreadDelete(Request $request)
    {

        $itemChatThread = ItemChat::find($request->id);


        $itemChatThread->delete();
        return response()->json([
            'message' => 'Chat deleted successfully!',
        ]);
    }

    public function ajaxCheckThreadExists(Request $request)
    {

        $itemChatThreadExists = ItemChat::where('uuid', $request->uuid)->exists();
        if ($itemChatThreadExists) {
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }

    public function sceneLimit()
    {
        $package = Package::where('id', auth()->user()->package_id)->first();

        $limit = auth()->user()->package_interval  === Package::MONTHLY ?  $package->scene_limit_monthly :  $package->scene_limit_yearly;
        if (auth()->user()->package_id !== 1) {
            $limit = $limit + Package::SCENE_LIMIT;
        }
        if ($limit >  auth()->user()->scenes->count()) {
            return true;
        }
        return false;
    }

    public function generatePDFItemPlace(Request $request)
    {

        set_time_limit(300);
        $itemChatThread = ItemChat::where('uuid', $request->uuid)->get();
        $uuid = $request->uuid;
        $item = Item::withTrashed()->find($request->itemId);

        $user = User::find($request->userId);
        $date = Carbon::createFromTimestamp($request->date)->diffForHumans();
        $isDeleted = filter_var($request->isDeleted, FILTER_VALIDATE_BOOLEAN);
        $myProjectDirectory = base_path();


        $html = View::make('user.scenes.item_chat_pdf', compact('itemChatThread', 'uuid', 'item', 'user', 'date', 'isDeleted'))->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->inline($request->uuid . 'thread.pdf');
    }

    public function saveCaption(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid' => 'required',
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        if ($request->id) {
            $itemChatCaption = ItemChatCaption::find($request->id);
            $itemChatCaption->uuid = $request->uuid;
            $itemChatCaption->description = $request->description;
            $itemChatCaption->save();
        } else {
            $itemChatCaption = new ItemChatCaption;
            $itemChatCaption->uuid = $request->uuid;
            $itemChatCaption->description = $request->description;
            $itemChatCaption->save();
        }
        return response()->json(['message' => 'Caption saved successfully', 'data' => $itemChatCaption->toArray()]);
    }

    public function invitation($id)
    {

        $invitedUsers = SceneInvitation::where('scene_id', $id)->pluck('email', 'id')->toArray();

        $invitedUsersList = SceneInvitation::where('scene_id', $id)->get();

        $scene = Scene::find($id);

        abort_if(auth()->user()->id !== $scene->user_id, 403);
        $html = view('user.scenes.invite_modal_ajax', compact('scene', 'invitedUsersList'))->render();

        return response()->json([
            'message' => 'Successfully!',
            'html' => $html,
            'invitedUsers' => $invitedUsers
        ]);
    }


    public function generatePDFScene($id)
    {
        set_time_limit(300);
        $scene = Scene::find($id);

        $isInvited = SceneInvitation::where('scene_id', $scene->id)
            ->where('email', auth()->user()->email)
            ->exists();
        if ($isInvited) {
            $getInvitationUser = User::where('email', auth()->user()->email)
                ->first();
        }
        $isHost = $scene->user_id == auth()->user()->id;

        if (!$isInvited && !$isHost) {

            abort(403, 'You are not allowed to access this account.');
        }
       
        $html = View::make('user.scenes.scene_pdf', compact('scene'))->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4');

        return $pdf->inline($scene->id . 'scene.pdf');
    }
}
