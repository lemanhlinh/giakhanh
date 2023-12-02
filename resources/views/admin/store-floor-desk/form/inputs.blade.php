<div class="row">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.store-floor-desk.name')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="name" value="{{ isset($store_floor_desk) ? $store_floor_desk->name : old('name') }}" required>
                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.store-floor.store_floor_id')</label>
                    <select name="store_floor_id" id="store_floor_id" class="form-control" required>
                        @if($store_floors)
                            @forelse($store_floors as $store_floor)
                                <option value="{{ $store_floor->id }}" {{ isset($store_floor_desk) ? $store_floor_desk->store_id == $store_floor->id ? 'selected': '' : old('store_id') }}>{{ $store_floor->name }}</option>
                            @empty
                            @endforelse
                        @endif
                    </select>
                    @if ($errors->has('store_id'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('store_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.store-floor-desk.number_desk')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="number_desk" value="{{ isset($store_floor_desk) ? $store_floor_desk->number_desk : old('number_desk') }}" required>
                    @if ($errors->has('number_desk'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('number_desk') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Loại bàn</label>
                    <select class="form-control" id="type" name="type">
                        @foreach($types as $k => $type)
                            <option value="{{ $k }}" {{ (isset($store_floor_desk) && $store_floor_desk->type == $k) ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group clearfix">
                    <label>@lang('form.page.active')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Store::STATUS_ACTIVE }}" {{ (isset($store_floor_desk->active) && $store_floor_desk->active == \App\Models\Store::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\Page::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Store::STATUS_INACTIVE }}" {{ (isset($store_floor_desk) && $store_floor_desk->active == \App\Models\Store::STATUS_INACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\Page::STATUS_INACTIVE)) ? 'checked' : '' }}  required>
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
    </div>
    <div class="col-sm-5">
{{--        @include('admin.store-floor-desk.form.ping')--}}
    </div>
</div>
@section('script')
    @parent
@endsection
