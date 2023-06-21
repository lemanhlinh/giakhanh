<div class="row">
    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.setting.name')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="name" value="{{ isset($setting) ? $setting->name : old('name') }}" required>
            @if ($errors->has('name'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.setting.key')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="key" value="{{ isset($setting) ? $setting->key : old('key') }}" required>
            @if ($errors->has('key'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('key') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label>@lang('form.setting.description')</label> <span class="text-danger">*</span>
            <textarea class="form-control" rows="3" name="description" >{{ isset($setting) ? $setting->description : old('description') }}</textarea>
            @if ($errors->has('description'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group clearfix">
            <label>@lang('form.setting.active')</label> <span class="text-danger">*</span>
            <div class="form-group">
                <div class="icheck-success d-inline">
                    <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Setting::STATUS_ACTIVE }}" {{ isset($setting->active) && $setting->active == \App\Models\Setting::STATUS_ACTIVE ? 'checked' : 'checked' }} required>
                    <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div class="icheck-danger d-inline">
                    <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Setting::STATUS_INACTIVE }}" {{ isset($setting->active) && $setting->active == \App\Models\Setting::STATUS_INACTIVE ? 'checked' : '' }} required>
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
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.setting.value')</label> <span class="text-danger">*</span>

        </div>
    </div>
</div>
