@extends('admin.layouts.admin')

@section('title_file', trans('form.store-floor-desk.'))

@section('content')
    <button type="button"  class="btn btn-primary mb-3" data-toggle="modal" data-target="#create-floor-modal"><i class="fa fa-plus"></i> @lang('form.button.create')</button>
    {!! $dataTable->table(['id' => 'store-floor-desk-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
    @include('admin.components.modals.create-floor-desk-modal')
@endsection

@section('script')
    @parent
    {!! $dataTable->scripts() !!}
@endsection
