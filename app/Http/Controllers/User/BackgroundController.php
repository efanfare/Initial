<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSceneRequest;
use App\Models\Background;
use App\Models\Item;
use App\Models\ItemChat;
use App\Models\Package;
use App\Models\PhotoBank;
use App\Models\Scene;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BackgroundController extends Controller
{


    public function index(Request $request)
    {
        $query = $request->input('search');

        $backgrounds = Item::where('tags', 'like', '%' . $query . '%')
            ->orWhere('title', 'LIKE', '%' . $query . '%')
            ->get();
        return view('user.photobank.item', compact('items'));
    }

    public function store(Request $request)
    {

        try {
            // Validate the form data
            $this->validate($request, [
                'title' => 'required|string|max:255',
                'background_image' => 'required|image|mimes:jpeg,png,jpg', // Remove the max validation here
            ], [
                'background_image.required' => 'Please select an image',
                'background_image.image' => 'Uploaded file format is not allowed. Try uploading an image of format jpeg or png',
                'background_image.mimes' => 'Uploaded file format is not allowed. Try uploading an image of format jpeg or png',
            ]);

            // Check if the uploaded file size exceeds 5MB (5242880 bytes)
            if ($request->hasFile('background_image')) {
                $maxSize = 5242880; // 5MB in bytes (1MB = 1024KB, 1KB = 1024 bytes)
                $fileSize = $request->file('background_image')->getSize(); // Get the file size in bytes

                if ($fileSize > $maxSize) {
                    return response()->json([
                        'message' => 'File size should not be more than 5MB. Try again',
                    ], 422);
                }
            }

            // Create a new Background instance and set its properties
            $background = new Background;
            $background->title = $request->title;
            $background->user_id = auth()->user()->id;

            // Save the background to the database
            $background->save();

            // Handle the uploaded file (if present and valid)
            if ($request->hasFile('background_image') && $request->file('background_image')->isValid()) {
                $background->addMediaFromRequest('background_image')->toMediaCollection('background_image');
            }

            // Render the view and send the JSON response
            $html = view('user.scenes.uploaded_background_ajax', compact('background'))->render();

            return response()->json([
                'message' => 'Your background file has been uploaded successfully!',
                'html' => $html
            ]);
        } catch (ValidationException $e) {
            // Validation failed, manually handle the error
            if ($e->errors()['background_image'][0] == 'The background image failed to upload.') {
                return response()->json(['message' => 'File size should not be more than 5MB. Try again'], 422);
            }
            return response()->json(['message' => '', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Handle other exceptions (if any)
            return response()->json(['message' => 'An error occurred while processing your request. Please try again.'], 500);
        }
    }


    public function update(Request $request, $id)
    {
    }


    public function delete(Request $request)
    {
        $existBackground = Scene::where('backgorund_id', $request->id)->count();
        $existBackgroundName = Background::where('id', $request->id)->first();


        if ($existBackground > 0) {

            return response()->json([
                'message' => 'This background is used in another scene.',
                // 'message' => 'This background ' . $existBackgroundName->title . ' is using your another scenes!',

            ], 422);
        } else {
            $background = Background::find($request->id);
            $allMedia = $background->getMedia('background_image');
            $background->forceDelete();
            foreach ($allMedia as $media) {
                $media->delete();
            }
        }
        return response()->json([
            'message' => 'This background ' . $existBackgroundName->title . ' was deleted successfully!',
        ]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $backgrounds = Background::where('user_id', auth()->user()->id)
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%');
            })
            ->orWhere(function ($query) use ($searchTerm) {
                $query->where('service_type', 'System')
                    ->where('title', 'like', '%' . $searchTerm . '%');
            })
            ->get();

        $backgroundId =  (int)$request->backgroundId;
        $html = view('user.scenes.search_user_background_ajax', compact('backgrounds', 'backgroundId'))->render();

        $html2 = view('user.scenes.search_system_background_ajax', compact('backgrounds', 'backgroundId'))->render();

        return response()->json([
            'message' => '',
            'html' => $html,
            'systemhtml' => $html2
        ]);
    }


    public function deleteBackgroundIndex($id)
    {

        $existBackground = Scene::where('backgorund_id', $id)->count();
        $existBackgroundName = Background::where('id', $id)->first();

        if ($existBackground > 0) {
            return redirect()->route('item.index')->with('message', 'This background ' . $existBackgroundName->title . ' is being used in your scenes!');
        } else {
            $background = Background::find($id);
            if ($background) {
                $allMedia = $background->getMedia('background_image');
                foreach ($allMedia as $media) {
                    $media->delete();
                }
            }
            $background->delete();
        }
        return redirect()->route('item.index')->with('message', 'This background ' . $existBackgroundName->title . ' was deleted successfully!');
    }
}
