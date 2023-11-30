@extends('admin.layouts.admin')

@section('title_file', trans('form.store-floor-desk.create'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.store-floor-desk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.store-floor-desk.form.inputs')
            <button type="submit" class="btn btn-primary">@lang('form.button.submit')</button>
        </form>
{{--        <button id="ckfinder-popup" class="button-a button-a-background" style="float: left">Open Popup</button>--}}
    </div>
@endsection



