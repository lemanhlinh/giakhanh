@extends('admin.layouts.admin')

@section('title_file', trans('form.book-table.create'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.book-table.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.book-table.form.inputs')
            <button type="submit" class="btn btn-primary">@lang('form.button.submit')</button>
        </form>
    </div>
@endsection

@section('script')
    @parent
@endsection

