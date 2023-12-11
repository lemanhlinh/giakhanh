<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.book-table.full_name')</label>
                    <input type="text" class="form-control" name="full_name" value="{{ isset($bookTable) ? $bookTable->full_name : old('full_name') }}" required>
                    @if ($errors->has('full_name'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('full_name') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.book-table.email')</label>
                    <input type="text" class="form-control" name="email" value="{{ isset($bookTable) ? $bookTable->email : old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.book-table.phone')</label>
                    <input type="text" class="form-control" name="phone" value="{{ isset($bookTable) ? $bookTable->phone : old('phone') }}" required>
                    @if ($errors->has('phone'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group clearfix">
                    <label>Cơ sở</label>
                    <select name="store_id" id="store_id" class="form-control" required>
                        @forelse( $stores as $key => $store)
                            <option value="{{ $store->id }}" {{ isset($bookTable->store_id) && $bookTable->store_id == $store->id ? 'selected' : old('store_id') == $store->id ? 'selected' : '' }}>{{  $store->title }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.book-table.book_time')</label>
                    <input type="text" class="form-control" name="book_time" value="{{ isset($bookTable) ? $bookTable->book_time : old('book_time') }}" required>
                    @if ($errors->has('book_time'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('book_time') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.book-table.book_hour')</label>
                    <input type="text" class="form-control" name="book_hour" value="{{ isset($bookTable) ? $bookTable->book_hour : old('book_hour') }}" required>
                    @if ($errors->has('book_hour'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('book_hour') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.book-table.number_customers')</label>
                    <input type="text" class="form-control" name="number_customers" value="{{ isset($bookTable) ? $bookTable->number_customers : old('number_customers') }}" required>
                    @if ($errors->has('number_customers'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('number_customers') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group clearfix">
                    <label>Trạng thái đặt bàn</label>
                    <select name="status" id="status" class="form-control" required>
                        @forelse( \App\Models\BookTable::TYPE as $key => $name)
                            <option value="{{ $key }}" {{ isset($bookTable->status) && $bookTable->status == $key ? 'selected' : old('status') == $key ? 'selected' : '' }}>{{ $name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.book-table.note')</label>
                    <textarea name="note" id="note" rows="3" class="form-control">{{ isset($bookTable) ? $bookTable->note : old('note') }}</textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.book-table.admin_note')</label>
                    <textarea name="admin_note" id="admin_note" rows="3" class="form-control">{{ isset($bookTable) ? $bookTable->admin_note : old('admin_note') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@section('link')
    @parent
@endsection

@section('script')
    @parent
@endsection
