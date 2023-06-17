@extends('admin.layouts.admin')

@section('title_file', trans('form.setting.create'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.setting.form.inputs')
            <button type="submit" class="btn btn-primary">@lang('form.button.submit')</button>
        </form>
{{--        <button id="ckfinder-popup" class="button-a button-a-background" style="float: left">Open Popup</button>--}}
    </div>
@endsection

@section('script')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const selectElement = document.getElementById('setting_type');

        selectElement.addEventListener('change', (event) => {
            Swal.fire({
                title: 'Bạn có chắc chắn không?',
                text: "Thông tin chưa lưu sẽ mất",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const selectedRoute = event.target.value;
                    window.location.href = `{{ route('admin.setting.create') }}?template=${selectedRoute}`;
                }
            })

        });
    </script>
    @if($template == '3')
        <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
        <script>
            const watchdog = new CKSource.EditorWatchdog();
            window.watchdog = watchdog;
            watchdog.setCreator( ( element, config ) => {
                return CKSource.Editor
                    .create( element, config )
                    .then( editor => {
                        return editor;
                    } )
            } );

            watchdog.setDestructor( editor => {
                return editor.destroy();
            } );

            watchdog.on( 'error', handleError );

            watchdog
                .create( document.querySelector( '#value' ), {
                    ckFinder: {
                        uploadUrl: '{{route('ckfinder_connector')}}?command=QuickUpload&type=Images&responseType=json',

                    },
                    removePlugins: ["MediaEmbedToolbar","Markdown"],
                    mediaEmbed: {
                        previewsInData:true
                    }
                } )
                .catch( handleError );

            function handleError( error ) {
                console.error( 'Oops, something went wrong!' );
                console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
                console.warn( 'Build id: ryu56eng8wy8-nohdljl880ze' );
                console.error( error );
            }
        </script>
        @include('ckfinder::setup')
    @endif
@endsection

