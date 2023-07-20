<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\StoreSceneRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Background;
use App\Models\Gallery;
use App\Models\Item;
use App\Models\ItemChat;
use App\Models\ItemChatThread;
use App\Models\Package;
use App\Models\PhotoBank;
use Illuminate\Http\Request;
use App\Models\Scene;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GalleryController extends Controller
{

    public function index(Request $request)
    {
        $galleries = Gallery::where('user_id', auth()->user()->id)
            ->with(['scenes' => function ($query) {
                $query->withTrashed();
            }])
            ->paginate(10);
        // dd($galleries);
        $scenes = Scene::where('user_id', auth()->user()->id)->get();
        return view('user.galleries.index', compact('galleries', 'scenes'));
    }

    public function create(Request $request)
    {
        $scenes = Scene::where('user_id', auth()->user()->id)->get();
        return view('user.galleries.create', compact('scenes'));
    }

    public function store(StoreGalleryRequest $request)
    {

        $gallery =  new Gallery;
        $gallery->title = $request->title;
        $gallery->user_id = $request->user()->id;
        $gallery->save();
        $gallery->scenes()->attach($request->input('scenes', []));
        return response()->json(['message' => 'Gallery collection created successfully'], 200);
    }


    public function edit($id)
    {

        $gallery  = Gallery::find($id);
        abort_if(auth()->user()->id !== $gallery->user_id, 403);
        // dd($gallery->scenes->first()->background->background_image?->preview);

        $scenes = Scene::where('user_id', auth()->user()->id)->get();
        $html = view('user.galleries.edit_modal_ajax', compact('gallery', 'scenes'))->render();

        return response()->json([
            'message' => 'Successfully!',
            'html' => $html,
        ]);
    }

    public function update(UpdateGalleryRequest $request, $id)
    {

        $gallery = Gallery::find($id);
        abort_if(auth()->user()->id !== $gallery->user_id, 403);
        $gallery->title =  $request->title;
        $gallery->update();

        $gallery->scenes()->sync($request->scenes ?? []);
        return response()->json(['message' => 'Gallery collection collection updated successfully'], 200);
    }

    public function delete(Request $request, $id)
    {
        $gallery = Gallery::find($id);

        if (auth()->user()->id !== $gallery->user_id) {
            abort(403, 'You do not have permission to access this gallery.');
        }
        $gallery->delete();
        return redirect()->back()->with('message', 'Gallery deleted successfully');
    }

    public function show($id)
    {

        $gallery  = Gallery::find($id);
        abort_if(auth()->user()->id !== $gallery->user_id, 403);

        $html = view('user.galleries.show_modal_ajax', compact('gallery'))->render();

        return response()->json([
            'message' => 'Successfully!',
            'html' => $html,
        ]);
    }
}
