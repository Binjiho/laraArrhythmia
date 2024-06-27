<form action="{{ route('overseas.data')}}" method="post" id="register-frm" data-sid="{{$overseas->sid ?? 0}}" data-case="overseas-{{ empty($overseas->sid) ? 'create' : 'update' }}" enctype="multipart/form-data" onsubmit="return false;">
    <input type="hidden" name="csid" id="csid" value="{{ $_GET['csid'] ?? 0  }}" >
    <input type="hidden" name="mypage" id="mypage" value="{{ $_GET['mypage'] ?? 'N' }}" >
    <fieldset>
        <legend class="hide">등록</legend>
        <div class="write-wrap">
            <dl>
                <dt>ID (E-mail)</dt>
                <dd>
                    {{ $user->uid ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>거주국가</dt>
                <dd>
                    {{ $country[$user->country ?? '']['cn'] ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>성명 (Name)</dt>
                <dd>
                    {{ $user->name_kr ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>소속 (병원명)</dt>
                <dd>
                    {{ $affi[$user->sosok ?? '' ]['office_e'] ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>부서 (학과명)</dt>
                <dd>
                    {{ $user->depart_kr ?? "" }}
                </dd>
            </dl>
            <dl>
                <dt>직책 (직함)</dt>
                <dd>
                    @foreach($userConfig['position'] as $position_key => $position_val)
                        {{ in_array($position_key, $user->position ?? []) ? $position_val :'' }}
                    @endforeach
                    @if(in_array('99',$user->position ?? []))
                        [ {{$user->position_etc ?? '' }} ]
                    @endif
                </dd>
            </dl>
            <dl>
                <dt>연락처</dt>
                <dd>
                    @foreach(($user->tel ?? []) as $key => $user_tel)
                        {{($key == 0 ? '':'-').$user_tel}}
                    @endforeach
                </dd>
            </dl>
            <dl>
                <dt>휴대폰번호</dt>
                <dd>
                    @foreach(($user->phone ?? []) as $key => $user_phone)
                        {{($key == 0 ? '':'-').$user_phone}}
                    @endforeach
                </dd>
            </dl>
            <dl>
                <dt>근무지 주소</dt>
                <dd>
                    {{$user->office_addr1 ?? ''}} {{$user->office_addr2 ?? ''}}
                </dd>
            </dl>
            <dl>
                <dt>근무지 구분</dt>
                <dd>
                    {{ $userConfig['office'][$user->office ?? '' ] ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>가입 구분</dt>
                <dd>
                    {{ $userConfig['category'][$user->category ?? ''] ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>전공 구분</dt>
                <dd>
                    {{ $userConfig['major'][$user->major ?? ''] ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>출신대학</dt>
                <dd>
                    {{ $user->university ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>최종학위</dt>
                <dd>
                    {{ $user->degree ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>최종학위 논문제목</dt>
                <dd>
                    {{ $user->degree_title ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>면허번호</dt>
                <dd>
                    {{ $user->license_number ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>전문의 1</dt>
                <dd>
                    {{ $user->major1 ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>전문의 2</dt>
                <dd>
                    {{ $user->major2 ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>분과 전문의</dt>
                <dd>
                    {{ $user->speciality ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>전공분야</dt>
                <dd>
                    {{ $user->major_field ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>진료분야</dt>
                <dd>
                    @foreach($userConfig['field'] as $field_key => $field_val)
                        {{ in_array($field_key, $user->field ?? []) ? ($field_key==1 ? '':',').$field_val :'' }}
                    @endforeach
                    @if(in_array('99',$user->field ?? []))
                        [ {{$user->field_etc ?? '' }} ]
                    @endif
                </dd>
            </dl>
        </div>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">신청자격</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt>신청자격</dt>
                <dd>
                    <div class="checkbox-wrap cst">
                        @foreach($overseasConfig['qualification'] as $qualification_key => $qualification_val)
                            <div class="checkbox-group">
                                <input type="checkbox" name="qualification[]" id="qualification_{{$qualification_key}}" value="{{$qualification_key}}" {{ in_array($qualification_key, $overseas->qualification ?? []) ? 'checked':'' }}>
                                <label for="qualification_{{$qualification_key}}">{{$qualification_val}}</label>
                            </div>
                        @endforeach

                    </div>
                </dd>
            </dl>
        </div>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">우선순위</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt>최우선순위</dt>
                <dd>
                    <div class="checkbox-wrap cst">
                        @foreach($overseasConfig['top'] as $top_key => $top_val)
                            <div class="checkbox-group">
                                <input type="checkbox" name="top[]" id="top_{{$top_key}}" value="{{$top_key}}" {{ in_array($top_key, $overseas->top ?? []) ? 'checked':'' }}>
                                <label for="top_{{$top_key}}">{{$top_val}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-10 top_class" style="{{ in_array('1',$overseas->top ?? [] ) ? 'display:block;':'display:none;' }} ">
                        <div class="form-group form-group-text">
                            <span class="text">논문제목: </span>
                            <input type="text" name="title" id="title" class="form-item" value="{{$overseas->title ?? ''}}">
                        </div>
                        <div class="form-group form-group-text mt-10">
                            <span class="text">저자정보: </span>
                            <select name="author" id="author" class="form-item" >
                                <option value="">선택</option>
                                @foreach($overseasConfig['author'] as $author_key => $author_val)
                                    <option value="{{$author_key}}" {{$author_key == ($overseas->author??'') ? 'selected':''}}>
                                        {{$author_val}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-group-text mt-10">
                            <span class="text">투고일자: </span>
                            <input type="text" name="submission_date" id="submission_date" class="form-item datepicker" value="{{$overseas->submission_date ?? ''}}" readonly>
                        </div>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 1순위</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($overseasConfig['first'] as $first_key => $first_val)
                            <div class="radio-group">
                                <input type="radio" name="first" id="first_{{$first_key}}" value="{{$first_key}}" {{ ($overseas->first ?? '') == $first_key ? 'checked' : '' }}>
                                <label for="first_{{$first_key}}">{{$first_val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 2순위</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($overseasConfig['second'] as $second_key => $second_val)
                            <div class="radio-group">
                                <input type="radio" name="second" id="second_{{$second_key}}" value="{{$second_key}}" {{ ($overseas->second ?? '') == $second_key ? 'checked' : '' }}>
                                <label for="second_{{$second_key}}">{{$second_val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 3순위</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($overseasConfig['third'] as $third_key => $third_val)
                            <div class="radio-group">
                                <input type="radio" name="third" id="third_{{$third_key}}" value="{{$third_key}}" {{ ($overseas->third ?? '') == $third_key ? 'checked' : '' }}>
                                <label for="third_{{$third_key}}">{{$third_val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>최근 3년간 대한부정맥학회 정기학술대회 (KHRS) 등록여부</dt>
                <dd>
                    <div class="checkbox-wrap cst full">
                        @foreach($overseasConfig['registration_status'] as $registration_status_key => $registration_status_val)
                            <div class="checkbox-group">
                                <input type="checkbox" name="registration_status[]" id="registration_status_{{$registration_status_key}}" value="{{$registration_status_key}}" {{ in_array($registration_status_key, $overseas->registration_status ?? []) ? 'checked':'' }}>
                                <label for="registration_status_{{$registration_status_key}}">{{$registration_status_val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
        </div>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">해외학회 참가 지원 신청</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt>참가신청 국제학술회의</dt>
                <dd>
                    {{$conference->subject ?? ''}}
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 참가 자격</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($overseasConfig['participant'] as $participant_key => $participant_val)
                            <div class="radio-group">
                                <input type="radio" name="participant" id="participant_{{$participant_key}}" value="{{$participant_key}}" {{ ($overseas->participant ?? '') == $participant_key ? 'checked' : '' }}>
                                <label for="participant_{{$participant_key}}">{{$participant_val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 공동 저자 여부</dt>
                <dd>
                    <div class="radio-wrap cst">
                        <div class="radio-group">
                            <input type="radio" name="common_author" id="common_author_1" value="Y" {{ ($overseas->common_author ?? '') == 'Y' ? 'checked' : '' }}>
                            <label for="common_author_1">예</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" name="common_author" id="common_author_2" value="N" {{ ($overseas->common_author ?? '') == 'N' ? 'checked' : '' }}>
                            <label for="common_author_2">아니오</label>
                        </div>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 초청/채택 메일</dt>
                <dd>
                    <dl>
                        <dt>메일 수신 날짜</dt>
                        <dd>
                            <input type="text" name="mail_date" id="mail_date" class="form-item datepicker" value="{{$overseas->mail_date ?? ''}}" readonly>
                        </dd>
                    </dl>
                    <dl>
                        <dt>메일 제목</dt>
                        <dd>
                            <input type="text" name="mail_title" id="mail_title" class="form-item" value="{{$overseas->mail_title ?? ''}}">
                        </dd>
                    </dl>
                    <dl>
                        <dt>발신인</dt>
                        <dd>
                            <input type="text" name="mail_from" id="mail_from" class="form-item" value="{{$overseas->mail_from ?? ''}}">
                        </dd>
                    </dl>
                    <dl>
                        <dt>수신인</dt>
                        <dd>
                            <input type="text" name="mail_to" id="mail_to" class="form-item" value="{{$overseas->mail_to ?? ''}}">
                        </dd>
                    </dl>
                    <dl>
                        <dt>초록제목</dt>
                        <dd>
                            <input type="text" name="abs_title" id="abs_title" class="form-item" value="{{$overseas->abs_title ?? ''}}">
                        </dd>
                    </dl>
                    <dl>
                        <dt>발표자</dt>
                        <dd>
                            <input type="text" name="presenter" id="presenter" class="form-item" value="{{$overseas->presenter ?? ''}}">
                        </dd>
                    </dl>
                    <dl>
                        <dt>수신한 메일 본문 (전체)</dt>
                        <dd>
                            <textarea name="mail_content" id="mail_content" cols="30" rows="10" class="form-item">{{$overseas->mail_content ?? ''}}</textarea>
                        </dd>
                    </dl>
                </dd>
            </dl>
            <dl>
                <dt>초청장/초록 업로드</dt>
                <dd>
                    <div class="filebox">
                        <input class="upload-name form-item" value="{{ $overseas->thumb_file ?? '' }}" placeholder="파일첨부">
                        <label for="thumb_file">파일첨부</label>
                        <input type="file" id="thumb_file" name="thumb_file" class="file-upload" accept=".xls,.xlsx,.pdf,.hwp,.doc,.docx">

                        @if(!empty($overseas->thumb_realfile))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('thumb_realfile', 'thumb_file') }}" target="_blank" class="link">{{$overseas->thumb_file}}</a>
                                {{--                                                <a href="{{$overseas->thumb_realfile}}" target="_blank" class="link">{{$overseas->thumb_file}}</a>--}}
                            </div>
                        @endif
                    </div>
                </dd>
            </dl>
            <!-- <dl>
                <dt>초청/채택메일 다운로드</dt>
                <dd>
                    <a href="#n" target="_blank" class="btn btn-small color-type2">워드파일 다운로드</a>
                    {{--                                    <a href="{{ route('staticDownload',['file_name'=>'research.docx', 'file_path'=>'/assets/file/research.docx']) }}" target="_blank" class="btn btn-small color-type2">신청서 다운로드 <span class="arrow">&gt;</span></a>--}}
                </dd>
            </dl> -->
            <dl>
                <dt><strong class="required">*</strong> 예금 계좌번호</dt>
                <dd>
                    <dl>
                        <dt>은행명</dt>
                        <dd>
                            <input type="text" name="bank_name" id="bank_name" class="form-item" value="{{ $overseas->bank_name ?? '' }}" onlyKo>
                        </dd>
                    </dl>
                    <dl>
                        <dt>계좌번호</dt>
                        <dd>
                            <input type="text" name="account_num" id="account_num" class="form-item" value="{{ $overseas->account_num ?? '' }}" onlyNumber>
                        </dd>
                    </dl>
                    <dl>
                        <dt>예금주</dt>
                        <dd>
                            <input type="text" name="account_name" id="account_name" class="form-item" value="{{ $overseas->account_name ?? '' }}" onlyKo>
                        </dd>
                    </dl>
                </dd>
            </dl>
        </div>
        @if( $isAdminPage )
            <div class="btn-wrap text-center">
                <button type="submit" class="btn btn-type1 color-type5">{{ empty($overseas->sid) ? '등록' : '수정' }}</button>
                <a href="" id="" onclick="self.close();" class="btn btn-type1 color-type4">취소</a>
            </div>
        @else
            @if( ($_GET['mypage'] ?? 'N') == 'Y')
                <div class="btn-wrap text-center">
                    <a href="{{route('mypage.overseas')}}" id="" class="btn btn-type1 color-type4">취소</a>
                    <button type="submit" class="btn btn-type1 color-type5">수정하기</button>
                </div>
            @elseif( ($_GET['mypage'] ?? 'N') == 'N' )
                <div class="btn-wrap text-center">
                    <a href="javascript:;" id="register_cancel" class="btn btn-type1 color-type4">취소</a>
                    <button type="submit" class="btn btn-type1 color-type5">미리보기</button>
                </div>
            @endif
        @endif
    </fieldset>
</form>