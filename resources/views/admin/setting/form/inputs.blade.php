<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label>Loại cấu hình</label>
            <select class="form-control" id="setting_type" name="type">
                @foreach($types as $k => $type)
                    <option value="{{ $k }}" {{ ($template && $template == $k) ?'selected':(isset($setting) && $setting->type == $k) ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
    </div>
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
            @if($template)
                @if($template === '0')
                    <input type="text" class="form-control" name="value" value="{{ isset($setting) ? $setting->value : old('value') }}" >
                @elseif($template === '1')
                    <textarea class="form-control" rows="3" name="value" >{{ isset($setting) ? $setting->value : old('value') }}</textarea>
                @elseif($template === '2')
                    <input type="file" class="form-control" id="value" name="value"
                           value="{{ isset($setting->value) ? $setting->value : old('value') }}" >
                    @if(isset($setting->value) && $setting->value != null)
                        <img src="{{ asset($setting->value) }}" width="200px" alt="">
                    @endif
                @elseif($template === '3')
                    <textarea id="value" name="value" class="form-control" rows="10" >{{ isset($setting->value) ? $setting->value : old('value') }}</textarea>
                @else
                    <input type="text" class="form-control" name="value" value="{{ isset($setting) ? $setting->value : old('value') }}" required>
                @endif
            @else
                @if(isset($setting) && $setting->type == 0)
                    <input type="text" class="form-control" name="value" value="{{ isset($setting) ? $setting->value : old('value') }}" >
                @elseif(isset($setting) && $setting->type == 1)
                    <textarea class="form-control" rows="3" name="value" >{{ isset($setting) ? $setting->value : old('value') }}</textarea>
                @elseif(isset($setting) && $setting->type == 2)
                    <input type="file" class="form-control" id="value" name="value"
                           value="{{ isset($setting->value) ? $setting->value : old('value') }}" >
                    @if(isset($setting->value) && $setting->value != null)
                        <img src="{{ asset($setting->value) }}" width="200px" alt="">
                    @endif
                @elseif(isset($setting) && $setting->type == 3)
                    <textarea id="value" name="value" class="form-control" rows="10" >{{ isset($setting->value) ? $setting->value : old('value') }}</textarea>
                @else
                    <input type="text" class="form-control" name="value" value="{{ isset($setting) ? $setting->value : old('value') }}" required>
                @endif
            @endif
            @if ($errors->has('value'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('value') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
