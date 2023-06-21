@extends('admin.layouts.admin')

@section('title_file', trans('form.setting.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.setting.form.inputs')
            <input type="hidden" name="id" value="{{ $setting->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection

@section('script')
    @parent
    <script>
        let role = new Role();
        role.checkFullPermission()
    </script>
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
                    window.location.href = `{{ route('admin.setting.edit', $setting->id) }}?template=${selectedRoute}`;
                }
            })

        });
    </script>
    @if($template === '3' || ($setting && $setting->type == 3) )
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
