@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.package.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.packages.update", [$package->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="package_name">{{ trans('cruds.package.fields.package_name') }}</label>
                <input class="form-control {{ $errors->has('package_name') ? 'is-invalid' : '' }}" type="text" name="package_name" id="package_name" value="{{ old('package_name', $package->package_name) }}" required>
                @if($errors->has('package_name'))
                    <span class="text-danger">{{ $errors->first('package_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.package_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price_monthly">{{ trans('cruds.package.fields.price_monthly') }}</label>
                <input class="form-control {{ $errors->has('price_monthly') ? 'is-invalid' : '' }}" type="number" name="price_monthly" id="price_monthly" value="{{ old('price_monthly', $package->price_monthly) }}" step="0.01" required>
                @if($errors->has('price_monthly'))
                    <span class="text-danger">{{ $errors->first('price_monthly') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.price_monthly_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price_yearly">{{ trans('cruds.package.fields.price_yearly') }}</label>
                <input class="form-control {{ $errors->has('price_yearly') ? 'is-invalid' : '' }}" type="number" name="price_yearly" id="price_yearly" value="{{ old('price_yearly', $package->price_yearly) }}" step="0.01" required>
                @if($errors->has('price_yearly'))
                    <span class="text-danger">{{ $errors->first('price_yearly') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.price_yearly_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="options">{{ trans('cruds.package.fields.options') }}</label>
                <input class="form-control {{ $errors->has('options') ? 'is-invalid' : '' }}" type="text" name="options" id="options" value="{{ old('options', $package->options) }}">
                @if($errors->has('options'))
                    <span class="text-danger">{{ $errors->first('options') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.options_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.package.fields.status') }}</label>
                @foreach(App\Models\Package::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $package->status) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="yearly_discount">{{ trans('cruds.package.fields.yearly_discount') }}</label>
                <input class="form-control {{ $errors->has('yearly_discount') ? 'is-invalid' : '' }}" type="number" name="yearly_discount" id="yearly_discount" value="{{ old('yearly_discount', $package->yearly_discount) }}" step="0.01" required>
                @if($errors->has('yearly_discount'))
                    <span class="text-danger">{{ $errors->first('yearly_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.yearly_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="scene_limit">{{ trans('cruds.package.fields.scene_limit') }}</label>
                <input class="form-control {{ $errors->has('scene_limit') ? 'is-invalid' : '' }}" type="number" name="scene_limit" id="scene_limit" value="{{ old('scene_limit', $package->scene_limit) }}" step="1">
                @if($errors->has('scene_limit'))
                    <span class="text-danger">{{ $errors->first('scene_limit') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.scene_limit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="item_limit">{{ trans('cruds.package.fields.item_limit') }}</label>
                <input class="form-control {{ $errors->has('item_limit') ? 'is-invalid' : '' }}" type="text" name="item_limit" id="item_limit" value="{{ old('item_limit', $package->item_limit) }}">
                @if($errors->has('item_limit'))
                    <span class="text-danger">{{ $errors->first('item_limit') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.item_limit_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('google_ads_free') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="google_ads_free" value="0">
                    <input class="form-check-input" type="checkbox" name="google_ads_free" id="google_ads_free" value="1" {{ $package->google_ads_free || old('google_ads_free', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="google_ads_free">{{ trans('cruds.package.fields.google_ads_free') }}</label>
                </div>
                @if($errors->has('google_ads_free'))
                    <span class="text-danger">{{ $errors->first('google_ads_free') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.google_ads_free_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.package.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $package->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.packages.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $package->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection