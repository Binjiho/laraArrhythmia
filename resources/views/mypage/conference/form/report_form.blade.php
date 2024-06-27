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
                <dd>{{ $overseasConfig['assistant'][$overseas->assistant] ?? '' }}</dd>
            </dl>
            <dl>
                <dt>
                    <strong class="required">*</strong> 참가결과 보고서
                    <a href="#n" class="btn btn-download color-type8" target="_blank">참가결과 보고서 <img src="/assets/image/sub/ic_download2.png" alt=""></a>
                    {{--                                    <a href="{{ route('staticDownload',['file_name'=>'research.docx', 'file_path'=>'/assets/file/research.docx']) }}" target="_blank" class="btn btn-small color-type2">신청서 다운로드 <span class="arrow">&gt;</span></a>--}}
                </dt>
                <dd>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName1" name="fileName1" value="{{ $overseas->file1 ?? '' }}" placeholder="업로드" readonly="readonly">
                        <label for="file1">업로드</label>
                        <input type="file" id="file1" name="file1" class="file_upload" value="" accept=".xls,.xlsx,.pdf,.hwp,.doc,.docx" data-accept="xls|xlsx|pdf|hwp|doc|docx" onchange="fileCheck(this,$('#fileName1'))" >
                        @if(!empty($overseas->realfile1))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('realfile1', 'file1') }}" target="_blank" class="link">{{$overseas->file1}}</a>
                            </div>
                        @endif
                    </div>
                    <div class="help-text text-red mt-10">
                        * 참가결과 보고서는 반드시 공식 양식을 다운 받아 작성하여 주십시오.
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 초록채택 메일 또는 초청장</dt>
                <dd>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName2" name="fileName2" value="{{ $overseas->file2 ?? '' }}" placeholder="업로드" readonly="readonly">
                        <label for="file2">업로드</label>
                        <input type="file" id="file2" name="file2" class="file_upload" value="" accept=".xls,.xlsx,.pdf,.hwp,.doc,.docx" data-accept="xls|xlsx|pdf|hwp|doc|docx" onchange="fileCheck(this,$('#fileName2'))" >
                        @if(!empty($overseas->realfile2))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('realfile2', 'file2') }}" target="_blank" class="link">{{$overseas->file2}}</a>
                            </div>
                        @endif
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>
                    <strong class="required">*</strong> 상세지출내역서
                    <a href="#n" class="btn btn-download color-type11" target="_blank">상세지출내역서 <img src="/assets/image/sub/ic_download2.png" alt=""></a>
                </dt>
                <dd>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName3" name="fileName3" value="{{ $overseas->file3 ?? '' }}" placeholder="업로드" readonly="readonly">
                        <label for="file3">업로드</label>
                        <input type="file" id="file3" name="file3" class="file_upload" value="" accept=".xls,.xlsx,.pdf,.hwp,.doc,.docx" data-accept="xls|xlsx|pdf|hwp|doc|docx" onchange="fileCheck(this,$('#fileName3'))" >
                        @if(!empty($overseas->realfile3))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('realfile3', 'file3') }}" target="_blank" class="link">{{$overseas->file3}}</a>
                            </div>
                        @endif
                    </div>
                    <div class="help-text text-red mt-10">
                        * 상세지출내역서는 반드시 공식 양식을 다운 받아 작성하여 주십시오.
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>
                    <strong class="required">*</strong> 영수증
                    <a href="#n" class="btn btn-download color-type13" target="_blank">영수증 첨부양식 <img src="/assets/image/sub/ic_download2.png" alt=""></a>
                </dt>
                <dd>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName4" name="fileName4" value="{{ $overseas->file4 ?? '' }}" placeholder="업로드" readonly="readonly">
                        <label for="file4">업로드</label>
                        <input type="file" id="file4" name="file4" class="file_upload" value="" accept=".xls,.xlsx,.pdf,.hwp,.doc,.docx" data-accept="xls|xlsx|pdf|hwp|doc|docx" onchange="fileCheck(this,$('#fileName4'))" >
                        @if(!empty($overseas->realfile4))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('realfile4', 'file4') }}" target="_blank" class="link">{{$overseas->file4}}</a>
                            </div>
                        @endif
                    </div>
                    <div class="help-text text-red mt-10">
                        * 영수증은 반드시 공식 양식을 다운 받아 작성하여 주십시오.
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>
                    <strong class="required">*</strong> 사유서
                    <a href="#n" class="btn btn-download color-type9" target="_blank">사유서 예시 안내 <img src="/assets/image/sub/ic_download2.png" alt=""></a>
                </dt>
                <dd>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName5" name="fileName5" value="{{ $overseas->file5 ?? '' }}" placeholder="업로드" readonly="readonly">
                        <label for="file5">업로드</label>
                        <input type="file" id="file5" name="file5" class="file_upload" value="" accept=".xls,.xlsx,.pdf,.hwp,.doc,.docx" data-accept="xls|xlsx|pdf|hwp|doc|docx" onchange="fileCheck(this,$('#fileName5'))" >
                        @if(!empty($overseas->realfile5))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('realfile5', 'file5') }}" target="_blank" class="link">{{$overseas->file5}}</a>
                            </div>
                        @endif
                    </div>
                    <div class="help-text text-red mt-10">
                        * 사유서는 반드시 공식 양식을 다운 받아 작성하여 주십시오.
                    </div>
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
                    <div class="form-group form-group-text w-40p">
                        <input type="text" name="pay1" id="pay1" value="{{ $overseas->pay1 ?? '' }}" class="form-item" priceFormat> <span class="text">원</span>
                    </div>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName6" name="fileName6" value="{{ $overseas->file6 ?? '' }}" placeholder="업로드" readonly="readonly">
                        <label for="file6">업로드</label>
                        <input type="file" id="file6" name="file6" class="file_upload" value="" accept=".pdf" data-accept="pdf" onchange="fileCheck(this,$('#fileName6'))" >
                        @if(!empty($overseas->realfile6))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('realfile6', 'file6') }}" target="_blank" class="link">{{$overseas->file6}}</a>
                            </div>
                        @endif
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 항공료</dt>
                <dd>
                    <div class="form-group form-group-text w-40p">
                        <input type="text" name="pay2" id="pay2" value="{{ $overseas->pay2 ?? '' }}" class="form-item" priceFormat> <span class="text">원</span>
                    </div>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName7" name="fileName7" value="{{ $overseas->file7 ?? '' }}" placeholder="업로드" readonly="readonly">
                        <label for="file7">업로드</label>
                        <input type="file" id="file7" name="file7" class="file_upload" value="" accept=".pdf" data-accept="pdf" onchange="fileCheck(this,$('#fileName7'))" >
                        @if(!empty($overseas->realfile7))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('realfile7', 'file7') }}" target="_blank" class="link">{{$overseas->file7}}</a>
                            </div>
                        @endif
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 숙박비</dt>
                <dd>
                    <div class="form-group form-group-text w-40p">
                        <input type="text" name="pay3" id="pay3" value="{{ $overseas->pay3 ?? '' }}" class="form-item" priceFormat> <span class="text">원</span>
                    </div>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName8" name="fileName8" value="{{ $overseas->file8 ?? '' }}" placeholder="업로드" readonly="readonly">
                        <label for="file8">업로드</label>
                        <input type="file" id="file8" name="file8" class="file_upload" value="" accept=".pdf" data-accept="pdf" onchange="fileCheck(this,$('#fileName8'))" >
                        @if(!empty($overseas->realfile8))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('realfile8', 'file8') }}" target="_blank" class="link">{{$overseas->file8}}</a>
                            </div>
                        @endif
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 식비</dt>
                <dd>
                    <div class="form-group form-group-text w-40p">
                        <input type="text" name="pay4" id="pay4" value="{{ $overseas->pay4 ?? '' }}" class="form-item" priceFormat> <span class="text">원</span>
                    </div>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName9" name="fileName9" value="{{ $overseas->file9 ?? '' }}" placeholder="업로드" readonly="readonly">
                        <label for="file9">업로드</label>
                        <input type="file" id="file9" name="file9" class="file_upload" value="" accept=".pdf" data-accept="pdf" onchange="fileCheck(this,$('#fileName9'))" >
                        @if(!empty($overseas->realfile9))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('realfile9', 'file9') }}" target="_blank" class="link">{{$overseas->file9}}</a>
                            </div>
                        @endif
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 기타 교통비</dt>
                <dd>
                    <div class="form-group form-group-text w-40p">
                        <input type="text" name="pay5" id="pay5" value="{{ $overseas->pay5 ?? '' }}" class="form-item" priceFormat> <span class="text">원</span>
                    </div>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName10" name="fileName10" value="{{ $overseas->file10 ?? '' }}" placeholder="업로드" readonly="readonly">
                        <label for="file10">업로드</label>
                        <input type="file" id="file10" name="file10" class="file_upload" value="" accept=".pdf" data-accept="pdf" onchange="fileCheck(this,$('#fileName10'))" >
                        @if(!empty($overseas->realfile10))
                            <div class="attach-file">
                                <a href="{{ $overseas->downloadFileUrl('realfile10', 'file10') }}" target="_blank" class="link">{{$overseas->file10}}</a>
                            </div>
                        @endif
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>계</dt>
                <dd>
                    <div class="form-group form-group-text w-40p">
                        <input type="text" name="tot_pay" id="tot_pay" value="{{ $overseas->tot_pay ?? '' }}" class="form-item" readonly> <span class="text">원</span>
                    </div>
                </dd>
            </dl>
        </div>

        <div class="contact-conbox">
            <div class="help-text text-red">
                ※ 관련 증빙서류는 스캔받아 파일로 첨부해주시고 원본은 학회사무국으로 보내주시기 바랍니다.
            </div>

            <div class="icon-conbox">
                <img src="/assets/image/sub/ic_contact.png" alt="">
                <div class="text-wrap">
                    <strong class="tit">대한부정맥학회 사무국</strong>
                    <ul>
                        <li>(우)04323 서울시 용산구 한강대로 372 센트레빌아스테리움 서울 A동 1604호</li>
                        <li><strong>전화. </strong> <a href="tel:02-318-5416" target="_blank">02-318-5416</a></li>
                        <li><strong>팩스. </strong> 02-318-5417</li>
                        <li><strong>이메일. </strong> <a href="mailto:khrs@k-hrs.org" target="_blank">khrs@k-hrs.org</a></li>
                    </ul>
                </div>
            </div>
            <div class="help-text text-red">
                ※ 제출 완료 후에는 수정이 불가능합니다.
            </div>
        </div>
        @if( ($_GET['mypage'] ?? 'N') == 'Y')
            <div class="btn-wrap text-center">
                <a href="javascript:;" class="btn btn-type1 color-type4" onclick="cancle();">취소</a>
                <button type="submit" class="btn btn-type1 color-type11">최종 제출</button>
            </div>
        @else
            <div class="btn-wrap text-center">
                <a href="javascript:;" class="btn btn-type1 color-type4" onclick="cancle();">취소</a>
                <a href="javascript:;" onclick="tempSubmit();" class="btn btn-type1 color-type5">임시저장</a>
                <button type="submit" class="btn btn-type1 color-type11">최종 제출</button>
            </div>
        @endif
    </fieldset>
</form>