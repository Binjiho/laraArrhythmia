<form id="register-frm" data-sid="{{ $registration->sid ?? 0 }}" data-case="registration-{{ empty($registration->sid) ? 'create' : 'update' }}" onsubmit="return false;">
    <fieldset>
        <legend class="hide">등록</legend>
        <div class="sub-contit-wrap mt-0">
            <h4 class="sub-contit">기본정보</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt>ID (E-mail)</dt>
                <dd>
                    {{ $registration->uid ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>성명 (영문)</dt>
                <dd>
                    {{ $registration->first_name ?? '' }} {{ $registration->last_name ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>성명 (국문)</dt>
                <dd>
                    {{ $registration->name_kr ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>소속</dt>
                <dd>
                    {{ $registration->sosok_kr ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>부서</dt>
                <dd>
                    {{ $registration->depart_kr ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>직책 (직함)</dt>
                <dd>
                    @foreach($userConfig['position'] as $position_key => $position_val)
                        @if( in_array($position_key, ($registration->position ?? []) ) )
                            {{$position_val}}
                        @endif
                    @endforeach
                    @if(!empty($registration->position_etc))
                        {{ $registration->position_etc ?? '' }}
                    @endif
                </dd>
            </dl>
            <dl>
                <dt>면허번호</dt>
                <dd>
                    {{ $registration->license_number ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>거주국가</dt>
                <dd>
                    {{ getCountryCn($registration->country ?? '1') }}
                </dd>
            </dl>
            <dl>
                <dt>연락처</dt>
                <dd>
                    {{ $registration->tel[0] ?? '' }}-{{ $registration->tel[1] ?? '' }}-{{ $registration->tel[2] ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>휴대폰번호</dt>
                <dd>
                    {{ $registration->phone[0] ?? '' }}-{{ $registration->phone[1] ?? '' }}-{{ $registration->phone[2] ?? '' }}
                </dd>
            </dl>
        </div>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">결제정보</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt>구분</dt>
                <dd>
                    {{ $registration->gubun ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>결제 수단</dt>
                <dd>
                    {{ $conferenceConfig['method'][$registration->method ?? '' ] }}
                </dd>
            </dl>
            <dl>
                <dt>송금인</dt>
                <dd>
                    {{ $registration->sender ?? '' }}
                </dd>
            </dl>
            <dl>
                <dt>송금예정일</dt>
                <dd>
                    {{ $registration->sender_date->format('Y-m-d') ?? '' }}
                </dd>
            </dl>
        </div>
        <div class="write-wrap">
            <dl>
                <dt>총 등록비</dt>
                <dd>
                    {{ number_format($registration->tot_pay) ?? 0 }} 원
                </dd>
            </dl>
            <dl>
                <dt>입금상태</dt>
                <dd>
                    {{ $conferenceConfig['pay_status'][$registration->pay_status ?? '' ] }}
                </dd>
            </dl>
        </div>

        <div class="btn-wrap text-center">
            <a href="#n" class="btn btn-type1 color-type20" onclick="alert('준비중입니다.')">영수증 출력</a>
            <a href="#n" class="btn btn-type1 color-type22" onclick="alert('준비중입니다.')">확인증 출력</a>
            <a href="{{ route('conference.registration.upsert',['sid'=>$registration->sid, 'csid'=>$conference->sid]) }}" class="btn btn-type1 color-type23">수정</a>
        </div>
    </fieldset>
</form>