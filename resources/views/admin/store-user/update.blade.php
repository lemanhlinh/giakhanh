@extends('admin.layouts.admin')

@section('title_file', trans('form.store-user.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.store-user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.store-user.form.inputs')
            <input type="hidden" name="id" value="{{ $user->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection
