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
                    <label>Cơ sở</label>
                    <select name="store_id" id="store_id" class="form-control" onchange="loadFloor(this.value)" required>
                        @forelse( $stores as $key => $store)
                            <option value="{{ $store->id }}" {{ isset($bookTable->store_id) && $bookTable->store_id == $store->id ? 'selected' : old('store_id') == $store->id ? 'selected' : '' }}>{{  $store->title }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group clearfix">
                    <label>Chọn tầng</label>
                    <select name="floor_id" id="floor_id" class="form-control" onchange="loadDesk(this.value)" required>
                        @forelse( $floors as $key => $floor)
                            <option value="{{ $floor->id }}" {{ isset($bookTable->floor_id) && $bookTable->floor_id == $floor->id ? 'selected' : old('floor_id') == $floor->id ? 'selected' : '' }}>{{  $floor->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group clearfix">
                    <label>Chọn bàn</label>
                    <select name="table_id" id="table_id" class="form-control" required>
                        @forelse( $desks as $key => $desk)
                            <option value="{{ $desk->id }}" {{ isset($bookTable->table_id) && $bookTable->table_id == $desk->id ? 'selected' : old('table_id') == $desk->id ? 'selected' : '' }}>{{  $desk->name }}</option>
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
    <script>
        function loadFloor(store_id) {
            $("#table_id").html(`<option data-id="0" value="0">Chọn bàn</option>`);
            $.ajax({
                type: 'post',
                url: '{{ route('admin.book-table.loadFloor') }}',
                dataType: 'JSON',
                data: {
                    store_id: store_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function (data) {
                    let option = ''
                    option += `<option data-id="0" value="0">Chọn Tầng</option>`;
                    data.floors.forEach(item => {
                        option += `<option value="${item.id}">${item.name}</option>`
                    });

                    $("#floor_id").html(option);
                    return true;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                }
            });
            return false;
        }

        function loadDesk(floor_id) {
            $.ajax({
                type: 'post',
                url: '{{ route('admin.book-table.loadDesk') }}',
                dataType: 'JSON',
                data: {
                    store_id: $('#store_id').val(),
                    floor_id: floor_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function (data) {
                    let option = ''
                    option += `<option data-id="0" value="0">Chọn bàn</option>`;
                    data.desks.forEach(item => {
                        option += `<option value="${item.id}">${item.name}</option>`
                    });

                    $("#table_id").html(option);
                    return true;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                }
            });
            return false;
        }
    </script>
@endsection
