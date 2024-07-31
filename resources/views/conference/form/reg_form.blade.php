<form id="board-frm" data-sid="{{ $conference->sid ?? 0 }}" data-case="conference-{{ empty($conference->sid) ? 'create' : 'update' }}" onsubmit="return false;">
    <fieldset>
        <legend class="hide">글쓰기</legend>
        <div class="write-wrap">
            <dl>
                <dt><strong class="required">*</strong> 공개여부</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($conferenceConfig['hide'] as $key => $val)
                            <div class="radio-group">
                                <input type="radio" name="hide" id="hide{{$key}}" value="{{$key}}" {{ ($conference->hide ?? '') == $key ? 'checked':'' }}>
                                <label for="hide{{$key}}">{{$val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 상세보기</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($conferenceConfig['detail'] as $key => $val)
                            <div class="radio-group">
                                <input type="radio" name="detail" id="detail{{$key}}" value="{{$key}}" {{ ($conference->detail ?? '') == $key ? 'checked':'' }}>
                                <label for="detail{{$key}}">{{$val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 행사구분</dt>
                <dd>
                    <select name="category" id="category" class="form-item" readonly>
                        <option value="">선택</option>
                        @foreach($conferenceConfig['category'] as $key => $val)
                            <option value="{{ $key }}" {{ ($conference->category ?? '') == $key ? 'selected':'' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 년도</dt>
                <dd>
                    <select name="year" id="year" class="form-item" readonly>
                        <option value="">선택</option>
                        @foreach($conferenceConfig['year'] as $key => $val)
                            <option value="{{ $val }}" {{ ($conference->year ?? '') == $val ? 'selected':'' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 행사명</dt>
                <dd>
                    <input type="text" name="subject" id="subject" class="form-item" value="{{ $conference->subject ?? '' }}">
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 행사 기간</dt>
                <dd>
                    <dl class="n2">
                        <dt class="text-left">시작일</dt>
                        <dd>
                            <input type="text" name="event_sdate" id="event_sdate" class="form-item datepicker" value="{{ empty($conference->sid) ? '' : $conference->event_sdate->format('Y-m-d') }}" readonly>
                        </dd>
                        <dt class="text-left">종료일</dt>
                        <dd>
                            <input type="text" name="event_edate" id="event_edate" class="form-item datepicker" value="{{ empty($conference->sid) ? '' : $conference->event_edate->format('Y-m-d') ?? '' }}" readonly>
                        </dd>
                    </dl>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong>행사 장소</dt>
                <dd>
                    <input type="text" name="place" id="place" class="form-item" value="{{ $conference->place ?? '' }}">
                </dd>
            </dl>
            <dl>
                <dt>홈페이지 URL</dt>
                <dd>
                    <input type="text" name="link_url" id="link_url" class="form-item" value="{{ $conference->link_url ?? '' }}">
                </dd>
            </dl>
            <dl>
                <dt>평점</dt>
                <dd>
                    <input type="text" name="avg" id="avg" class="form-item" value="{{ $conference->avg ?? '' }}">
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 문의처</dt>
                <dd>
                    <dl>
                        <dt>이름</dt>
                        <dd>
                            <input type="text" name="contact_name" id="contact_name" class="form-item" value="{{ $conference->contact_name ?? '대한부정맥학회' }}">
                        </dd>
                    </dl>
                    <dl>
                        <dt>TEL</dt>
                        <dd>
                            <input type="text" name="contact_tel" id="contact_tel" class="form-item" value="{{ $conference->contact_tel ?? '02-318-5416' }}" phoneHyphen>
                        </dd>
                    </dl>
                    <dl>
                        <dt>E-mail</dt>
                        <dd>
                            <input type="text" name="contact_email" id="contact_email" class="form-item" value="{{ $conference->contact_email ?? 'khrs@k-hrs.org' }}">
                        </dd>
                    </dl>
                </dd>
            </dl>

            <dl class="detailY" style="{{ ($conference->invite_text ?? '') == '' ? 'display:none;': ''  }}">
                <dt> 초대의 글</dt>
                <dd>
                    <textarea name="invite_text" id="invite_text" class="tinymce" >{{ $conference->invite_text ?? '' }}</textarea>
                </dd>
            </dl>
            <dl class="detailY" style="{{ ($conference->invite_text ?? '') == '' ? 'display:none;': ''  }}">
                <dt><strong class="required">*</strong> 행사 일정</dt>
                <dd>
                    <textarea name="schedule_text" id="schedule_text" class="tinymce">{{ $conference->schedule_text ?? '' }}</textarea>
                </dd>
            </dl>
            <dl>
                <dt>썸네일 이미지</dt>
                <dd>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName1" name="fileName1" value="{{ $conference->thumb_file ?? '' }}" placeholder="파일 업로드" readonly="readonly">
                        <label for="thumb_file">파일 업로드</label>
                        <input type="file" id="thumb_file" name="thumb_file" class="file-upload" accept="image/jpg, image/jpeg, image/png" data-accept="jpeg|jpg|png" onchange="fileCheck(this,$('#fileName1'))">
                        @if (!empty($conference->thumb_file))
                            <div class="attach-file">
                                <a href="{{ $conference->downloadFileUrl('thumb_realfile', 'thumb_file') }}" target="_blank" class="link">{{$conference->thumb_file}}</a>
                                <a href="javascript:void(0);" class="file_del" data-type="thumb" data-path="{{ $conference->thumb_realfile }}"><img src="{{ asset('assets/image/icon/icon_del.png') }}" alt="삭제"></a>
                            </div>
                        @endif
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 사전등록 사용</dt>
                <dd>
                    <div class="radio-wrap cst">
                        <div class="radio-group">
                            <input type="radio" name="regist_yn" id="regist_ynN" value="N" {{ ($conference->regist_yn ?? '') == 'N' ? 'checked' : '' }}>
                            <label for="regist_ynN">사용 안함</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" name="regist_yn" id="regist_ynY" value="Y" {{ ($conference->regist_yn ?? '') == 'Y' ? 'checked' : ''  }}>
                            <label for="regist_ynY">사용</label>
                        </div>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>사전등록 기간</dt>
                <dd>
                    <dl class="n2">
                        <dt class="text-left">시작일</dt>
                        <dd>
                            <input type="text" name="regist_sdate" id="regist_sdate" class="form-item datepicker"  value="{{ !empty($conference->sid) && isValidTimestamp($conference->regist_sdate) ? $conference->regist_sdate->format('Y-m-d') : '' }}" readonly>
                        </dd>
                        <dt class="text-left">종료일</dt>
                        <dd>
                            <input type="text" name="regist_edate" id="regist_edate" class="form-item datepicker"  value="{{ !empty($conference->sid) && isValidTimestamp($conference->regist_edate) ? $conference->regist_edate->format('Y-m-d') : '' }}" readonly>
                        </dd>
                    </dl>
                </dd>
            </dl>
            <dl>
                <dt>기타안내</dt>
                <dd>
                    <textarea name="etc_text" id="etc_text" class="tinymce">{{ $conference->etc_text ?? '' }}</textarea>
                </dd>
            </dl>
            <dl >
                <dt><strong class="required">*</strong> 선착순 등록</dt>
                <dd>
                    <div class="n2" >
                        <div class="radio-wrap cst">
                            <div class="radio-group">
                                <input type="radio" name="limit_yn" id="limit_ynN" value="N" {{ ($conference->limit_yn ?? '') == 'N' ? 'checked':'' }}>
                                <label for="limit_ynN">사용 안함</label>
                            </div>
                            <div class="radio-group">
                                <input type="radio" name="limit_yn" id="limit_ynY" value="Y" {{ ($conference->limit_yn ?? '') == 'Y' ? 'checked':'' }}>
                                <label for="limit_ynY">사용</label>
                            </div>
                        </div>

                        <input type="text" name="limit_person" id="limit_person" class="form-item n2" value="{{ $conference->limit_person ?? '' }}" onlyNumber {{ ($conference->limit_yn ?? '') == 'Y' ? '' : 'disabled' }}>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 신청 권한</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($conferenceConfig['res_authority'] as $key => $val)
                            <div class="radio-group">
                                <input type="radio" name="res_authority" id="res_authority{{$key}}" value="{{$key}}" {{ ($conference->res_authority ?? '') == $key ? 'checked' : '' }}>
                                <label for="res_authority{{$key}}">{{$val}}</label>
                            </div>
                        @endforeach

                        <div class="radio-group">
                            <select name="res_authority_etc" id="res_authority_etc" class="form-item" {{ ($conference->authority ?? '') == '4' ? '' : 'disabled' }}>
                                <option value="">선택</option>
                                @foreach($res_authority_etc as $key => $val)
                                    <option value="{{ $key }}" {{ ($conference->res_authority_etc ?? '') == $key ? 'selected':'' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 등록비</dt>
                <dd>
                    <div class="help-text text-blue">등록비는 콤마(,) 없이 숫자만 입력하세요.</div>
                    <div class="table-wrap scroll-x touch-help mt-10">
                        <table class="cst-table">
                            <caption class="hide">등록비</caption>
                            <colgroup>
                                <col style="width: 45%;">
                                <col>
                                <col>
                                <col style="width: 20%;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th scope="row">등록 구분</th>
                                <th scope="row">사전 등록비</th>
                                <th scope="row">현장 등록비</th>
                                <th scope="row">관리</th>
                            </tr>
                            </thead>
                            <tbody id="fee_tbl">
                            @if(!empty($conference->sid))
                                @foreach($conference->res_fee as $res_key => $res_val)
                                <tr>
                                    <td class="text-left">
                                        <input type="text" name="regist_gubun[]" value="{{ $res_val['gubun'] }}" class="form-item">
                                    </td>
                                    <td class="text-left">
                                        <input type="text" name="regist_early[]" value="{{ $res_val['early'] }}" id="" class="form-item" priceFormat>
                                    </td>
                                    <td class="text-left">
                                        <input type="text" name="regist_onsite[]" value="{{ $res_val['onsite'] }}" id="" class="form-item" priceFormat>
                                    </td>
                                    <td>
                                        <div class="btn-admin">
                                            <a href="javascript:;" onclick="change_tr(this,'add');" class="btn btn-board btn-modify">추가</a>
                                            <a href="javascript:;" onclick="change_tr(this,'del');" class="btn btn-board btn-delete">삭제</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-left">
                                        <input type="text" name="regist_gubun[]" class="form-item">
                                    </td>
                                    <td class="text-left">
                                        <input type="text" name="regist_early[]" id="" class="form-item" priceFormat>
                                    </td>
                                    <td class="text-left">
                                        <input type="text" name="regist_onsite[]" id="" class="form-item" priceFormat>
                                    </td>
                                    <td>
                                        <div class="btn-admin">
                                            <a href="javascript:;" onclick="change_tr(this,'add');" class="btn btn-board btn-modify">추가</a>
                                            <a href="javascript:;" onclick="change_tr(this,'del');" class="btn btn-board btn-delete">삭제</a>
                                        </div>
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>등록 항목</dt>
                <dd>
                    <div class="help-text text-blue">기본 세팅 항목에 추가로 입력 받을 항목을 1개 이상 선택 해주세요.</div>
                    <div class="checkbox-wrap cst mt-10">
                        @foreach($conferenceConfig['add_item'] as $key => $val)
                            <div class="radio-group">
                                <input type="checkbox" name="add_item[]" id="add_item{{$key}}" value="{{$key}}" {{ in_array($key, $conference->add_item ?? []) ? 'checked':'' }} >
                                <label for="add_item{{$key}}">{{$val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 입금계좌</dt>
                <dd>
                    <input type="text" name="account" id="account" class="form-item" value="{{ ($conference->account ?? '우리은행 1005-403-444745 (예금주 : 대한부정맥학회)') }}">
                </dd>
            </dl>
            <dl>
                <dt>환불규정</dt>
                <dd>
                    <textarea name="refund_text" id="refund_text" class="tinymce">{{ $conference->refund_text ?? '' }}</textarea>
                </dd>
            </dl>
            <dl>
                <dt>유의사항</dt>
                <dd>
                    <textarea name="notice_text" id="notice_text" class="tinymce">{{ $conference->notice_text ?? '' }}</textarea>
                </dd>
            </dl>
            <dl>
                <dt>개인정보취급방침</dt>
                <dd>
                    <textarea name="privacy_text" id="privacy_text" class="tinymce">{{ $conference->privacy_text ?? '' }}</textarea>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 초록접수 사용</dt>
                <dd>
                    <div class="radio-wrap cst">
                        <div class="radio-group">
                            <input type="radio" name="abs_yn" id="abs_yn1" value="N" {{ ($conference->abs_yn ?? '') == 'N' ? 'checked' : '' }}>
                            <label for="abs_yn1">사용 안함</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" name="abs_yn" id="abs_yn2" value="Y" {{ ($conference->abs_yn ?? '') == 'Y' ? 'checked' : '' }}>
                            <label for="abs_yn2">사용</label>
                        </div>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>초록접수 기간</dt>
                <dd>
                    <dl class="n2">
                        <dt class="text-left">시작일</dt>
                        <dd>
                            <input type="text" name="abs_sdate" id="abs_sdate" class="form-item datepicker" value="{{ !empty($conference->sid) && isValidTimestamp($conference->abs_sdate) ? $conference->abs_sdate->format('Y-m-d') : '' }}" readonly>
                        </dd>
                        <dt class="text-left">종료일</dt>
                        <dd>
                            <input type="text" name="abs_edate" id="abs_edate" class="form-item datepicker" value="{{ !empty($conference->sid) && isValidTimestamp($conference->abs_edate) ? $conference->abs_edate->format('Y-m-d') : '' }}" readonly>
                        </dd>
                    </dl>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 신청 권한</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($conferenceConfig['abs_authority'] as $key => $val)
                            <div class="radio-group">
                                <input type="radio" name="abs_authority" id="abs_authority{{$key}}" value="{{$key}}" {{ ($conference->abs_authority ?? '') == $key ? 'checked' : '' }}>
                                <label for="abs_authority{{$key}}">{{$val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 구분</dt>
                <dd>
                    <div class="checkbox-wrap cst">
                        @foreach($conferenceConfig['abs_gubun'] as $key => $val)
                            <div class="radio-group">
                                <input type="checkbox" name="abs_gubun[]" id="abs_gubun{{$key}}" value="{{$key}}" {{ in_array($key, $conference->abs_gubun ?? []) ? 'checked':'' }}>
                                <label for="abs_gubun{{$key}}">{{$val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>주의사항</dt>
                <dd>
                    <textarea name="caution_text" id="caution_text" class="tinymce">{{ $conference->caution_text ?? '' }}</textarea>
                </dd>
            </dl>
            <dl>
                <dt>오시는 길</dt>
                <dd>
                    <dl>
                        <dt>주소</dt>
                        <dd>
                            <div class="form-group has-btn">
                                <input type="text" name="zipcode" id="zipcode" value="{{ $conference->zipcode ?? '' }}" class="form-item" readonly>
                                <a href="#n" class="btn btn-small color-type2 post-code">우편번호 찾기</a>
                            </div>
                            <div class="form-group n2 mt-10">
                                <input type="text" name="addr1" id="addr1" value="{{ $conference->addr1 ?? '' }}" class="form-item clear" readonly>
                                <input type="text" name="addr2" id="addr2" value="{{ $conference->addr2 ?? '' }}" class="form-item">
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>연락처</dt>
                        <dd>
                            <input type="text" name="tel" id="tel" value="{{ $conference->tel ?? '' }}" class="form-item" phoneHyphen>
                        </dd>
                    </dl>
                </dd>
            </dl>
        </div>
        <div class="btn-wrap text-center">
            <a href="javacript:;" class="btn btn-type1 color-type4" id="board_cancel">취소</a>
            <button type="submit" class="btn btn-type1 color-type5">{{ empty($conference->sid) ? '등록':'수정' }}</button>
            <!-- <button type="submit" class="btn btn-type1 color-type5">수정</button> -->
        </div>
    </fieldset>
</form>