<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSceneRequest;
use App\Models\Background;
use App\Models\Item;
use App\Models\ItemChat;
use App\Models\Package;
use App\Models\PhotoBank;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Exceptions\PostTooLargeException;

class ItemController extends Controller
{


    public function index(Request $request)
    {
        $searchQuery  = $request->input('search');

        $items = Item::where(function ($query) use ($searchQuery) {
            $query->where('tags', 'like', '%' . $searchQuery . '%')
                ->orWhere('title', 'LIKE', '%' . $searchQuery . '%');
        })->where('user_id', auth()->user()->id)
            ->latest()
            ->paginate(12, ['*'], 'item_page');

        $userBackgrounds = Background::where('user_id', auth()->user()->id)
            ->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%');
            })
            ->orWhere(function ($query) use ($searchQuery) {
                $query->where('service_type', 'System')
                    ->where('title', 'like', '%' . $searchQuery . '%');
            })
            ->latest()
            ->orderBy('service_type', 'asc')
            ->paginate(12, ['*'], 'bg_page');



        return view('user.photobank.item', compact('items', 'userBackgrounds', 'searchQuery'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the form data
            $this->validate($request, [
                'title' => 'required|string|max:30',
                'itemKeyword' => 'required',
                'item_image' => 'required|image|mimes:jpeg,png,jpg', // Remove the max validation here
            ], [
                'item_image.required' => 'Please select an image',
                'item_image.image' => 'Uploaded file format is not allowed. Try uploading an image of format jpeg or png',
                'item_image.mimes' => 'Uploaded file format is not allowed. Try uploading an image of format jpeg or png',
            ]);

            // Check if the uploaded file size exceeds 2MB
            if ($request->hasFile('item_image')) {
                $maxSize = 2097152; // 2MB in bytes (1MB = 1024KB, 1KB = 1024 bytes)
                $fileSize = $request->file('item_image')->getSize(); // Get the file size in bytes

                if ($fileSize > $maxSize) {
                    return response()->json([
                        'message' => 'File size should not be more than 2MB. Try again',
                    ], 422);
                }
            }

            // Create a new Item instance and set its properties
            $item = new Item;
            $item->title = $request->title;
            $item->user_id = auth()->user()->id;
            $tags = explode(',', $request->input('itemKeyword')); // Convert comma-separated string to array
            $item->tags = json_encode($tags);

            // Save the item to the database
            $item->save();

            // Handle the uploaded file (if present and valid)
            if ($request->hasFile('item_image') && $request->file('item_image')->isValid()) {
                $item->addMediaFromRequest('item_image')->toMediaCollection('item_image');
            }

            // Render the view and send the JSON response
            $html = view('user.scenes.uploaded_items_ajax', compact('item'))->render();

            return response()->json([
                'message' => 'Your item has been uploaded successfully!',
                'html' => $html
            ]);
        } catch (ValidationException $e) {
            // Validation failed, manually handle the error
            if ($e->errors()['item_image'][0] == 'The item image failed to upload.') {
                return response()->json(['message' => 'File size should not be more than 2MB. Try again'], 422);
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
        $existingPhotoBank = PhotoBank::where('item_id', $request->id)->first();


        if ($existingPhotoBank) {

            $item = Item::find($request->id);
            return response()->json([
                'message' => 'This item ' . $item->title . ' is being used in your photobank!',
            ], 422);
        } else {
            $item = Item::find($request->id);
            $allMedia = $item->getMedia('item_image');
            $item->forceDelete();
            foreach ($allMedia as $media) {
                $media->delete();
            }
        }
        return response()->json([
            'message' => 'Item deleted successfully!',

        ]);
    }


    public function addPhotoBank(Request $request)
    {

        // dd($request->all());
        $item = Item::find($request->id);

        if (!$this->itemLimit($request->sceneId)) {
            return response()->json([
                'message' => 'Your photobank item limit is reached for this scene. Kindly buy subscription to continue.',
            ], 422);
        }

        $existingPhotoBank = PhotoBank::where('item_id', $item->id)
            ->where('scene_id', $request->sceneId)
            ->first();

        if ($existingPhotoBank) {
            return response()->json([
                'message' => 'This item already exists into photo bank.',
            ], 422);
        } else {
            // Record does not exist, create a new one
            $photoBank = $item->photoBank()->create([
                'item_id' => $item->id,
                'scene_id' => $request->sceneId,
            ]);
            $html = view('user.scenes.photobank_ajax', compact('photoBank'))->render();
            return response()->json([
                'message' => 'This item has been uploaded into Photo Bank.',
                'html' => $html
            ]);
        }
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $items = Item::where(function ($query) use ($searchTerm) {
            $query->where('tags', 'like', '%' . $searchTerm . '%')
                ->orWhere('title', 'LIKE', '%' . $searchTerm . '%');
        })
            ->where('user_id', auth()->user()->id)
            ->get();

        $photoBanks = PhotoBank::with('item')
            ->whereHas('item', function ($query) use ($searchTerm) {
                $query->where('tags', 'like', '%' . $searchTerm . '%')
                    ->orWhere('title', 'LIKE', '%' . $searchTerm . '%');
            })
            ->where('scene_id', $request->sceneId)
            ->get();

        $html = view('user.scenes.search_items_ajax', compact('items'))->render();
        $photoBankHtml = view('user.scenes.search_photo_banks_ajax', compact('photoBanks'))->render();

        return response()->json([
            'message' => '',
            'html' => $html,
            'photoBankHtml' => $photoBankHtml
        ]);
    }


    public function deletePhotoBankIndex($id)
    {

        $existingPhotoBank = PhotoBank::where('item_id', $id)->first();

        if ($existingPhotoBank) {

            $item = Item::find($id);
            return redirect()->back()->with('error', 'This item ' . $item->title . ' is being used in your photobank!');
        } else {
            $item = Item::find($id);
            if ($item) {
                $allMedia = $item->getMedia('item_image');
                foreach ($allMedia as $media) {
                    $media->delete();
                }
            }
            $item->forceDelete();
        }
        return redirect()->back()->with('message', 'Item deleted successfully');
    }

    public function itemLimit($sceneId)
    {
        $package = Package::where('id', auth()->user()->package_id)->first();

        $limit = auth()->user()->package_interval  === Package::MONTHLY ?  $package->item_limit_monthly :  $package->item_limit_yearly;
        if (auth()->user()->package_id !== 1) {
            $limit = $limit + Package::UPLOAD_CUSTOM_ITEM;
        }
        // $photoBanks = PhotoBank::whereHas('item', function ($query) {
        //     $query->where('user_id', auth()->user()->id);
        // })
        $photoBanks = PhotoBank::where('scene_id', $sceneId)
            ->count();

        if ($limit > $photoBanks) {
            return true;
        }
        return false;
    }
}
