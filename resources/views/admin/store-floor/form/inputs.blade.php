<div class="row">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.store-floor.name')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="name" value="{{ isset($store_floor) ? $store_floor->name : old('name') }}" required>
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
                    <label>@lang('form.store-floor.store_id')</label>
                    <select name="store_id" id="store_id" class="form-control" required>
                        @if($stores)
                        @forelse($stores as $store)
                            <option value="{{ $store->id }}" {{ isset($store_floor) ? $store_floor->store_id == $store->id ? 'selected': '' : old('store_id') }}>{{ $store->title }}</option>
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
                <div class="form-group clearfix">
                    <label>@lang('form.store-floor.active')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\StoreFloor::STATUS_ACTIVE }}" {{ (isset($store_floor->active) && $store_floor->active == \App\Models\StoreFloor::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\StoreFloor::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\StoreFloor::STATUS_INACTIVE }}" {{ (isset($store_floor) && $store_floor->active == \App\Models\StoreFloor::STATUS_INACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\StoreFloor::STATUS_INACTIVE)) ? 'checked' : '' }}  required>
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
    </div>
</div>
@section('script')
    @parent
@endsection
