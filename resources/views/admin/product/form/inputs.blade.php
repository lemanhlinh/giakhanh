<div class="row">
{{--    đánh dấu loại tin tức--}}
    <input type="hidden" value="0" name="type" id="type">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product.title')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="title" value="{{ isset($product) ? $product->title : old('title') }}" required>
                    @if ($errors->has('title'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product.slug')</label> <span class="text-danger">(@lang('form.auto_slug'))</span>
                    <input type="text" class="form-control" name="slug" value="{{ isset($product) ? $product->slug : old('slug') }}">
                    @if ($errors->has('slug'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('slug') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group clearfix">
                    <label>@lang('form.product.active')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Product::STATUS_ACTIVE }}" {{ (isset($product->active) && $product->active == \App\Models\product::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\product::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Product::STATUS_INACTIVE }}" {{ (isset($product) && $product->active == \App\Models\product::STATUS_INACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\product::STATUS_INACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio2" class="custom-control-label">@lang('form.status.inactive')</label>
                        </div>
                    </div>
                    @if ($errors->has('active'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('active') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group clearfix">
                    <label>@lang('form.product.is_home')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="homeRadio1" name="is_home" value="{{ \App\Models\Product::IS_HOME }}" {{ (isset($product->is_home) && $product->is_home == \App\Models\product::IS_HOME) ? 'checked' : (old('is_home') && (old('is_home') == \App\Models\product::IS_HOME)) ? 'checked' : '' }}  required>
                            <label for="homeRadio1" class="custom-control-label">@lang('form.status.is_home')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="homeRadio2" name="is_home" value="{{ \App\Models\Product::IS_NOT_HOME }}" {{ (isset($product) && $product->is_home == \App\Models\product::IS_NOT_HOME) ? 'checked' : (old('is_home') && (old('is_home') == \App\Models\product::IS_NOT_HOME)) ? 'checked' : '' }}  required>
                            <label for="homeRadio2" class="custom-control-label">@lang('form.status.is_not_home')</label>
                        </div>
                    </div>
                    @if ($errors->has('is_home'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('is_home') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.product.category')</label> <span class="text-danger">*</span>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @forelse($categories as $key => $category)
                            <option value="{{ $category['id'] }}" {{ isset($product->category_id) && $product->category_id == $category['id'] ? 'selected' : old('category_id') == $category['id'] ? 'selected' : '' }}>{{ $category['title'] }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.product.image')</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image"
                                   value="{{ isset($product->image) ? $product->image : old('image') }}">
                            <label class="custom-file-label" for="image">Choose file</label>
                            <span id="output"></span>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    @if(isset($product->image) && $product->image != null)
                        <img src="{{ asset($product->image) }}" width="200px" alt="">
                    @endif
                    @if ($errors->has('image'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product.ordering')</label>
                    <input type="text" class="form-control" name="ordering" value="{{ isset($product) ? $product->ordering : old('ordering') }}" >
                    @if ($errors->has('ordering'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>@lang('form.description')</label> <span class="text-danger">*</span>
                    <textarea class="form-control" rows="3" name="description" required >{{ isset($product) ? $product->description : old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>@lang('form.content')</label> <span class="text-danger">*</span>
                    <textarea id="content" name="content" class="form-control" rows="10" >{{ isset($product->content) ? $product->content : old('content') }}</textarea>
                    @if ($errors->has('content'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
                    @endif
                    <div class="editor"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">SEO</h3>
            </div>
            <div class="card-body p-3">
                <div class="form-group">
                    <label>@lang('form.seo_title')</label>
                    <input type="text" class="form-control" name="seo_title" value="{{ isset($product) ? $product->seo_title : old('seo_title') }}" >
                    @if ($errors->has('seo_title'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>@lang('form.seo_keyword')</label>
                    <input type="text" class="form-control" name="seo_keyword" value="{{ isset($product) ? $product->seo_keyword : old('seo_keyword') }}" >
                    @if ($errors->has('seo_keyword'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_keyword') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>@lang('form.seo_description')</label>
                    <textarea class="form-control" rows="3" name="seo_description" >{{ isset($product) ? $product->seo_description : old('seo_description') }}</textarea>
                    @if ($errors->has('seo_description'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    @parent
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
    <script>
        const watchdog = new CKSource.EditorWatchdog();
        window.watchdog = watchdog;

        watchdog.setCreator((element, config) => {
            return CKSource.Editor.create(element, config)
                .then(editor => {
                    return editor;
                });
        });

        watchdog.setDestructor(editor => {
            return editor.destroy();
        });

        watchdog.on('error', handleError);

        watchdog
            .create(document.querySelector('#content'), {
                ckFinder: {
                    uploadUrl: '{{route('ckfinder_connector')}}?command=QuickUpload&type=Images&responseType=json',
                },
                removePlugins: ['MediaEmbedToolbar', 'Markdown'],
                mediaEmbed: {
                    previewsInData: true
                }
            })
            .catch(handleError);

        function handleError(error) {
            console.error('Oops, something went wrong!');
            console.error('Please report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
            console.warn('Build id: ryu56eng8wy8-nohdljl880ze');
            console.error(error);
        }
    </script>
    @include('ckfinder::setup')
@endsection
