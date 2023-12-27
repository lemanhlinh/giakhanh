<button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#update-floor-desk-modal-{{$q->id}}" title="{{ trans('form.button.edit') }}"><i class="fa fa-edit"></i></button>
<!-- Modal -->
<div id="update-floor-desk-modal-{{$q->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang("form.store-floor.create")</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('admin.store-floor-desk.update' , $q->id) }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $q->id }}" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('form.store-floor-desk.name')</label> <span class="text-danger">*</span>
                        <input type="text" class="form-control" name="name" value="{{ isset($q) ? $q->name : old('name') }}" required>
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
                            <option value="{{ \App\Models\StoreFloor::STATUS_ACTIVE }}" @if($q->active == \App\Models\StoreFloor::STATUS_ACTIVE) selected @endif>@lang('form.status.active')</option>
                            <option value="{{ \App\Models\StoreFloor::STATUS_INACTIVE }}" @if($q->active == \App\Models\StoreFloor::STATUS_INACTIVE) selected @endif>@lang('form.status.inactive')</option>
                        </select>
                        @if ($errors->has('active'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('active') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>@lang('form.store-floor-desk.number_desk')</label> <span class="text-danger">*</span>
                        <input type="text" class="form-control" name="number_desk" value="{{ isset($q) ? $q->number_desk : old('number_desk') }}" required>
                        @if ($errors->has('number_desk'))
                            <span class="help-block text-danger">
                    <strong>{{ $errors->first('number_desk') }}</strong>
                </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Loại bàn</label>
                        <select class="form-control" id="type" name="type">
                            @foreach($types as $k => $type)
                                <option value="{{ $k }}" {{ (isset($q) && $q->type == $k) ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {!! $q->image_qr !!}
                <div class="modal-footer">
                    <input type="hidden" name="store_id" value="{{ $q->store->id }}">
                    <input type="hidden" name="store_floor_id" value="{{ $q->storeFloor->id }}">
                    <button type="submit" class="btn btn-success">@lang('form.button.save')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('form.button.close')</button>
                </div>
            </form>
        </div>
    </div>
</div>
