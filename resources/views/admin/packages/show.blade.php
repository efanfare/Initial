@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.package.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.id') }}
                        </th>
                        <td>
                            {{ $package->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.package_name') }}
                        </th>
                        <td>
                            {{ $package->package_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.price_monthly') }}
                        </th>
                        <td>
                            {{ $package->price_monthly }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.price_yearly') }}
                        </th>
                        <td>
                            {{ $package->price_yearly }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.options') }}
                        </th>
                        <td>
                            {{ $package->options }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Package::STATUS_RADIO[$package->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.yearly_discount') }}
                        </th>
                        <td>
                            {{ $package->yearly_discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.stripe_plan') }}
                        </th>
                        <td>
                            {{ $package->stripe_plan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.scene_limit') }}
                        </th>
                        <td>
                            {{ $package->scene_limit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.item_limit') }}
                        </th>
                        <td>
                            {{ $package->item_limit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.google_ads_free') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $package->google_ads_free ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.package.fields.description') }}
                        </th>
                        <td>
                            {!! $package->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection