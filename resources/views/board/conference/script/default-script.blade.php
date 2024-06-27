<script>
    const dataUrl = '{{ route('board.data', ['code' => $code, 'category'=> $category]) }}';
    const boardCode = '{{ $code }}';
    const boardConfig = @json($boardConfig);
    const popupMinWidth = 500;
    const popupMinHeight = 400;
    const boardForm = '#board-frm';
    const replyForm = '#reply-frm';
</script>
<script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('plugins/plupload/2.3.6/plupload.full.min.js') }}"></script>
<script src="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/jquery.plupload.queue.min.js') }}"></script>
<script src="{{ asset('script/plupload-tinymce.common.js') }}?v={{ config('site.app.asset_version') }}"></script>
{{--<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>--}}
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>