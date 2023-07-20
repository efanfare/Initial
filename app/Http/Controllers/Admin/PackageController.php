<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPackageRequest;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Package;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($request->ajax()) {
            $query = Package::query()->select(sprintf('%s.*', (new Package)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'package_show';
                $editGate      = 'package_edit';
                $deleteGate    = 'package_delete';
                $crudRoutePart = 'packages';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('package_name', function ($row) {
                return $row->package_name ? $row->package_name : '';
            });
            $table->editColumn('price_monthly', function ($row) {
                return $row->price_monthly ? $row->price_monthly : '';
            });
            $table->editColumn('price_yearly', function ($row) {
                return $row->price_yearly ? $row->price_yearly : '';
            });
            $table->editColumn('options', function ($row) {
                return $row->options ? $row->options : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Package::STATUS_RADIO[$row->status] : '';
            });
            $table->editColumn('yearly_discount', function ($row) {
                return $row->yearly_discount ? $row->yearly_discount : '';
            });
            $table->editColumn('scene_limit', function ($row) {
                return $row->scene_limit ? $row->scene_limit : '';
            });
            $table->editColumn('item_limit', function ($row) {
                return $row->item_limit ? $row->item_limit : '';
            });
            $table->editColumn('google_ads_free', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->google_ads_free ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'google_ads_free']);

            return $table->make(true);
        }

        return view('admin.packages.index');
    }

    public function create()
    {
        abort_if(Gate::denies('package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.packages.create');
    }

    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $package->id]);
        }

        return redirect()->route('admin.packages.index');
    }

    public function edit(Package $package)
    {
        abort_if(Gate::denies('package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.packages.edit', compact('package'));
    }

    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->all());

        return redirect()->route('admin.packages.index');
    }

    public function show(Package $package)
    {
        abort_if(Gate::denies('package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.packages.show', compact('package'));
    }

    public function destroy(Package $package)
    {
        abort_if(Gate::denies('package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $package->delete();

        return back();
    }

    public function massDestroy(MassDestroyPackageRequest $request)
    {
        $packages = Package::find(request('ids'));

        foreach ($packages as $package) {
            $package->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('package_create') && Gate::denies('package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Package();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
