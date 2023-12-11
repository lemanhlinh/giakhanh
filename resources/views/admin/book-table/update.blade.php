@extends('admin.layouts.admin')

@section('title_file', trans('form.book-table.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.book-table.update', $bookTable->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.book-table.form.inputs')
            <input type="hidden" name="id" value="{{ $bookTable->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection

@section('script')
    @parent
@endsection
