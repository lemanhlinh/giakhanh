<!-- Modal -->
<div id="create-floor-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang("form.store-floor.create")</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('admin.store-floor.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('form.store-floor.name')</label> <span class="text-danger">*</span>
                        <input type="text" class="form-control" name="name" value="{{ isset($store_floor) ? $store_floor->name : old('name') }}" required>
                        @if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <label for="">@lang("form.user.status")</label> <span class="text-danger">*</span>
                        <select name="active" class="form-control" required>
                            <option value="" hidden>@lang('form.user.status')</option>
                            <option value="{{ \App\Models\StoreFloor::STATUS_ACTIVE }}" @if(old('active') == \App\Models\StoreFloor::STATUS_ACTIVE) selected @endif>@lang('form.status.active')</option>
                            <option value="{{ \App\Models\StoreFloor::STATUS_INACTIVE }}" @if(old('active') == \App\Models\StoreFloor::STATUS_INACTIVE) selected @endif>@lang('form.status.inactive')</option>
                        </select>
                        @if ($errors->has('active'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('active') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <button type="submit" class="btn btn-success">@lang('form.button.save')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('form.button.close')</button>
                </div>
            </form>
        </div>
    </div>
</div>
