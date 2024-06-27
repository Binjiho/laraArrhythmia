<form action="{{ route('overseas.data')}}" method="post" id="register-frm" data-sid="{{$_GET['sid'] ?? 0 }}" data-case="overseas-report-{{ $overseas->result_request_state == 'N' ? 'create' : 'update' }}" enctype="multipart/form-data" onsubmit="return false;">
    <input type="hidden" name="mypage" id="mypage" value="{{ $_GET['mypage'] ?? 'N' }}" >
    <fieldset>
        <legend class="hide">결과보고서 및 서류 제출</legend>
        <div class="write-wrap">
            <dl class="n2">
                <dt>성명</dt>
                <dd>{{$user->name_kr ?? ''}}</dd>
                <dt>소속</dt>
                <dd>{{$affi[$user->sosok ?? '']['office_e']}}</dd>
            </dl>
            <dl class="n2">
                <dt>면허번호</dt>
                <dd>{{$user->license_number ?? ''}}</dd>
                <dt>전공 및 직위</dt>
                <dd>{{ $userConfig['major'][$user->major ?? ''] }} @if(!empty($user->major_etc))({{ $user->major_etc ?? '' }})@endif / @foreach($userConfig['position'] as $position_key => $position_val)
                        {{ in_array($position_key, $user->position ?? []) ? $position_val :'' }}
                    @endforeach
                    @if(in_array('99',$user->position ?? []))
                        [ {{$user->position_etc ?? '' }} ]
                    @endif</dd>
            </dl>
            <dl class="n2">
                <dt>전문의 취득년도</dt>
                <dd>{{ $user->major1_year ? $user->major1_year.'년' : ''  }}</dd>
                <dt>참가한 기간</dt>
                <dd>YYYY.MM.DD ~ YYYY.MM.DD</dd>
            </dl>
            <dl class="n2">
                <dt>장소</dt>
                <dd>{{ $overseas->conference->place ?? '' }}</dd>
                <dt>참가한 학회</dt>
                <dd>{{ $overseas->conference->subject ?? '' }}</dd>
            </dl>
            <dl>
                <dt>지원협회</dt>
                <dd>{{ $overseasConfig['assistant'][$overseas->assistant] }}</dd>
            </dl>
            <dl>
                <dt>
                    <strong class="required">*</strong> 참가결과 보고서
                </dt>
                <dd>
                    <a href="{{ $overseas->downloadFileUrl('realfile1', 'file1') }}" target="_blank" class="link">{{$overseas->file1}}</a>
                </dd>
            </dl>
            <dl>
                <dt>
                    <strong class="required">*</strong> 초록채택 메일 또는 초청장
                </dt>
                <dd>
                    <a href="{{ $overseas->downloadFileUrl('realfile2', 'file2') }}" target="_blank" class="link">{{$overseas->file2}}</a>
                </dd>
            </dl>
            <dl>
                <dt>
                    <strong class="required">*</strong> 상세지출내역서
                </dt>
                <dd>
                    <a href="{{ $overseas->downloadFileUrl('realfile3', 'file3') }}" target="_blank" class="link">{{$overseas->file3}}</a>
                </dd>
            </dl>
            <dl>
                <dt>
                    <strong class="required">*</strong> 영수증
                </dt>
                <dd>
                    <a href="{{ $overseas->downloadFileUrl('realfile4', 'file4') }}" target="_blank" class="link">{{$overseas->file4}}</a>
                </dd>
            </dl>
            <dl>
                <dt>
                    <strong class="required">*</strong> 사유서
                </dt>
                <dd>
                    <a href="{{ $overseas->downloadFileUrl('realfile5', 'file5') }}" target="_blank" class="link">{{$overseas->file5}}</a>
                </dd>
            </dl>
        </div>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">경비지원 입력</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt><strong class="required">*</strong> 등록비</dt>
                <dd>
                    {{ $overseas->pay1 ?? '' }}원
                    <a href="{{ $overseas->downloadFileUrl('realfile6', 'file6') }}" target="_blank" class="link">{{$overseas->file6}}</a>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 항공료</dt>
                <dd>
                    {{ $overseas->pay2 ?? '' }}원
                    <a href="{{ $overseas->downloadFileUrl('realfile7', 'file7') }}" target="_blank" class="link">{{$overseas->file7}}</a>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 숙박비</dt>
                <dd>
                    {{ $overseas->pay3 ?? '' }}원
                    <a href="{{ $overseas->downloadFileUrl('realfile8', 'file8') }}" target="_blank" class="link">{{$overseas->file8}}</a>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 식비</dt>
                <dd>
                    {{ $overseas->pay4 ?? '' }}원
                    <a href="{{ $overseas->downloadFileUrl('realfile9', 'file9') }}" target="_blank" class="link">{{$overseas->file9}}</a>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 기타 교통비</dt>
                <dd>
                    {{ $overseas->pay5 ?? '' }}원
                    <a href="{{ $overseas->downloadFileUrl('realfile10', 'file10') }}" target="_blank" class="link">{{$overseas->file10}}</a>
                </dd>
            </dl>
            <dl>
                <dt>계</dt>
                <dd>
                    {{ $overseas->tot_pay ?? '' }}원
                </dd>
            </dl>
        </div>

        <div class="btn-wrap text-center">
            <a href="javascript:;" class="btn btn-type1 color-type4" onclick="cancle();">취소</a>
        </div>
    </fieldset>
</form>