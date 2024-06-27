@extends($extends_str)

@section('addStyle')

@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">국내외 학술행사</h3>
            </div>
            <div id="board" class="event-wrap board-wrap" data-sid="{{ $conference->sid }}">
                <div class="ev-banner">
                    <strong class="ev-tit">{{ $conference->subject }}</strong>
                    <ul>
                        <li>{{ $conference->event_sdate->format('Y-m-d') }} ~ {{ $conference->event_edate->format('Y-m-d') }}</li>
                        <li>{{ $conference->place ?? '' }}</li>
                    </ul>
                </div>

                @include('conference.include.tabArea')

                <div class="ev-complete-conbox">
                    <div class="complete-contop">
                        <img src="/assets/image/sub/ic_complete.png" alt="">
                        <p>
                            <strong>{{ $conference->subject }}</strong> <br>
                            사전등록이 완료 되었습니다.
                        </p>
                    </div>
                    <div class="bg-box text-center">
                        문의사항이 있으신 경우 사무국으로 문의 부탁 드립니다. <br>
                        대한부정맥학회 사무국  <br class="m-br">TEL. <a href="tel:02-318-5416" target="_blank">02-318-5416</a>    E-mail. <a href="mailto:khrs@k-hrs.org" target="_blank">khrs@k-hrs.org</a>
                    </div>
                    <div class="btn-wrap text-center">
                        <a href="{{ route('conference') }}" class="btn btn-type1 color-type14">학술행사 리스트 바로가기</a>
                        <a href="{{ route('conference.confirm',['sid'=>$conference->sid, 'tab'=>'3']) }}" class="btn btn-type1 color-type15">사전등록 조회</a>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('conference.data') }}';

        $(document).on('click', 'input:checkbox[name="position[]"]', function() {
            if($(this).val() == '99') {
                if($(this).is(':checked')) {
                    $('#position_etc').attr('disabled', false);
                }else {
                    $('#position_etc').attr('disabled', 'disabled');
                    $('#position_etc').val('');
                }
            }
        });
    </script>
@endsection
