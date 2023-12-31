@extends('admin.layouts.admin')

@section('title_file', trans('form.page.'))

@section('content')
    <div class="col-md-3">
        @include('admin.components.buttons.change_lang',['url'=> route('admin.page.index')])
    </div>
    <a href="{{ route('admin.page.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> @lang('form.button.create')</a>
    {!! $dataTable->table(['id' => 'page-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
@endsection

@section('script')
    @parent
    {!! $dataTable->scripts() !!}
@endsection
