<form id="register-frm" name="register-frm" data-sid="{{ $abstract->sid ?? 0 }}" data-case="abstract-{{ ($abstract->status ?? 'N') == 'N' ? 'create' : 'update' }}" onsubmit="return false;">
    <input type="hidden" name="csid" id="csid" value="{{ $conference->sid ?? 0 }}" readonly>
    <input type="hidden" name="tab" id="tab" value="{{ $tab ?? 4 }}" readonly>
    <fieldset>
        <legend class="hide">등록</legend>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">접수자 정보</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt>ID (E-mail)</dt>
                <dd>
                    {{ $abstract->uid ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>성명 (국문)</dt>
                <dd>
                    {{ $abstract->name_kr ?? '' }}
                </dd>
            </dl>
        </div>

        <div class="write-wrap">
            <dl>
                <dt> 희망발표형식</dt>
                <dd>
                    {{ $conferenceConfig['abs_type'][$abstract->type ?? ''] }}
                </dd>
            </dl>
            <dl>
                <dt> 구분</dt>
                <dd>
                    {{ $conferenceConfig['abs_gubun'][$abstract->gubun ?? ''] }}
                    @if($abstract->gubun_etc)
                        {{ $abstract->gubun_etc }}
                    @endif
                </dd>
            </dl>
            <dl>
                <dt> 제목</dt>
                <dd>
                    <div class="form-group form-group-text">
                        <span class="text">국문 : </span>
                        {{ $abstract->title_kr ?? '' }}
                    </div>
                    <div class="form-group form-group-text mt-10">
                        <span class="text">영문 : </span>
                        {{ $abstract->title_en ?? '' }}
                    </div>
                </dd>
            </dl>
            <dl>
                <dt> 연구자</dt>
                <dd>
                    <div class="form-group form-group-text">
                        <span class="text">국문 : </span>
                        {{ $abstract->research_kr ?? '' }}
                    </div>
                    <div class="form-group form-group-text mt-10">
                        <span class="text">영문 : </span>
                        {{ $abstract->research_kr ?? '' }}
                    </div>
                </dd>
            </dl>
            <dl>
                <dt> 소속</dt>
                <dd>
                    <div class="form-group form-group-text">
                        <span class="text">국문 : </span>
                        {{ $abstract->sosok_kr ?? '' }}
                    </div>
                    <div class="form-group form-group-text mt-10">
                        <span class="text">영문 : </span>
                        {{ $abstract->sosok_kr ?? '' }}
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>첨부파일</dt>
                <dd>
                    @if (!empty($abstract->thumb_file))
                        {{ $abstract->thumb_file ?? '' }}
                    @endif
                </dd>
            </dl>
        </div>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">초록 본문</h4>
        </div>

        @if ($abstract->type=='O')
        <input type="hidden" name="tot_byte" id="tot_byte" value="{{ $abstract->tot_byte ?? '0' }}" class="form-item w-10p" readonly>

        <div class="write-wrap otype" style="{{ ($abstract->type ?? 'O') == 'O' ? '' : 'display:none' }}">
            <div class="write-tit text-right">
                <input type="text" name="tot_byte_o" id="tot_byte_o" value="{{ $abstract->tot_byte ?? '0' }}" class="form-item w-10p" readonly> / 최대 300 단어
            </div>
            <dl>
                <dt> 서론</dt>
                <dd>
                    {!! $abstract->o_intro !!}
                </dd>
            </dl>
            <dl>
                <dt> 증례</dt>
                <dd>
                    {!! $abstract->o_case !!}
                </dd>
            </dl>
            <dl>
                <dt> 결론</dt>
                <dd>
                    {!! $abstract->o_result !!}
                </dd>
            </dl>
        </div>
        @elseif($abstract->type=='P')
        <div class="write-wrap ptype" style="{{ ($abstract->type ?? 'O') == 'P' ? '' : 'display:none' }}">
            <div class="write-tit text-right">
                <input type="text" name="tot_byte_p" id="tot_byte_p" value="{{ $abstract->tot_byte ?? '0' }}" class="form-item w-10p" readonly/> / 최대 300 단어
            </div>
            <dl>
                <dt> 목적</dt>
                <dd>
                    {!! $abstract->p_object !!}
                </dd>
            </dl>
            <dl>
                <dt> 대상 및 방법</dt>
                <dd>
                    {!! $abstract->p_method !!}
                </dd>
            </dl>
            <dl>
                <dt> 결과</dt>
                <dd>
                    {!! $abstract->p_result !!}
                </dd>
            </dl>
            <dl>
                <dt> 결론</dt>
                <dd>
                    {!! $abstract->p_conclusion !!}
                </dd>
            </dl>
        </div>
        @endif

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">발표자 정보</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt> 발표자 성명</dt>
                <dd>
                    {{ $abstract->p_name ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt> 소속</dt>
                <dd>
                    {{ $abstract->p_sosok ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt> 직위</dt>
                <dd>
                    {{ $conferenceConfig['p_position'][$abstract->p_position ?? ''] }}
                    @if($abstract->p_position_etc)
                        {{ $abstract->p_position_etc }}
                    @endif
                </dd>
            </dl>
            <dl>
                <dt> 이메일</dt>
                <dd>
                    {{ $abstract->p_email ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt> 휴대폰번호</dt>
                <dd>
                    {{ $abstract->p_phone[0] ?? '' }}-{{ $abstract->p_phone[1] ?? '' }}-{{ $abstract->p_phone[2] ?? '' }}
                </dd>
            </dl>
        </div>

        <div class="btn-wrap text-center">
            <a href="{{ route('conference.detail',['sid'=>$abstract->csid]) }}" class="btn btn-type1 color-type4">취소</a>
            @if(($abstract->status ?? 'N') == 'N')
                <button type="submit" class="btn btn-type1 color-type18">최종접수</button>
            @else
                <a href="{{ route('conference.abstract.upsert',['sid'=>$abstract->sid, 'csid'=>$abstract->csid]) }}" class="btn btn-type1 color-type18">수정하기</a>
            @endif
        </div>
    </fieldset>
</form>