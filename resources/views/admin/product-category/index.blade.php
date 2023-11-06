@extends('admin.layouts.admin')
@section('link')
    @parent
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
@endsection
@section('title_file', trans('form.product_category.'))

@section('content')
    <div class="col-md-3">
        @include('admin.components.buttons.change_lang',['url'=> route('admin.product-category.index')])
    </div>
    <a href="{{ route('admin.product-category.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> @lang('form.button.create')</a>
    {!! $dataTable->table(['id' => 'product-category-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
@endsection

@section('script')
    @parent
    {!! $dataTable->scripts() !!}
@endsection
