@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="mypage">
            @if(session()->has('modify'))
                @include('page.web.auth.form.step2')
            @else
                <h4 class="pointTit">기본정보</h4>

                <table class="tblDef rwTbl al">
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: *;">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th><span class="essen" title="필수">회원등급</span></th>
                        <td>
                            {{ $userConfig['level'][thisUser()->level] }} {{ thisUser()->level_etc ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">아이디</span></th>
                        <td>{{ thisUser()->uid }}</td>
                    </tr>
                    </tbody>
                </table>

                <h4 class="pointTit">개인정보</h4>
                <table class="tblDef rwTbl al">
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: 30%;">
                        <col style="width: 20%;">
                        <col style="width: 30%;">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th><span class="essen" title="필수">이름 (국문)</span></th>
                        <td colspan="3">{{ thisUser()->name_kr }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">이름 (한자)</span></th>
                        <td colspan="3">{{ thisUser()->name_ch }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">이름 (영문)</span></th>
                        <td colspan="3">{{ thisUser()->first_name }} {{ thisUser()->last_name }}</td>
                    </tr>
                    <tr>
                        <th><span class="label">해외 국적</span></th>
                        <td colspan="3">{{ thisUser()->overseas_yn === 'N' ? '해당없음' : ('여권번호: ' . thisUser()->passport_num) }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">Title</span></th>
                        <td colspan="3">{{ $userConfig['title'][thisUser()->title] }} {{ thisUser()->title_etc ?? '' }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">생년월일</span></th>
                        <td>{{ thisUser()->birth }}</td>
                        <th><span class="essen" title="필수">성별</span></th>
                        <td>{{ $userConfig['sex'][thisUser()->sex] }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">E-mail</span></th>
                        <td>{{ thisUser()->email }}</td>

                        <th>추가 E-mail</th>
                        <td>{{ thisUser()->email2 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">휴대폰번호</span></th>
                        <td colspan="3">{{ thisUser()->phone }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">면허번호</span></th>
                        <td>{{ thisUser()->license_number }}</td>
                        <th><span class="essen" title="필수">취득년도</span></th>
                        <td>{{ thisUser()->license_year }}</td>
                    </tr>
                    <tr>
                        <th><span class="label">전문의번호</span></th>
                        <td>{{ thisUser()->director_number }}</td>
                        <th><span class="label">취득년도</span></th>
                        <td>{{ thisUser()->director_year }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">출신의과대학</span></th>
                        <td colspan="3">{{ (thisUser()->university == 9999) ? thisUser()->university_etc : thisUser()->university()->first()->university }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">인턴수련병원</span></th>
                        <td colspan="3">{{ (thisUser()->intern_hospital == 9999) ? thisUser()->intern_hospital_etc : thisUser()->hospital('intern_hospital')->first()->hospital }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">인턴수련기간</span></th>
                        <td colspan="3">{{ thisUser()->intern_sYear . '.' . thisUser()->intern_sMonth }} ~ {{ thisUser()->intern_eYear . '.' . thisUser()->intern_eMonth }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">레지던트수련병원</span></th>
                        <td colspan="3">{{ (thisUser()->resident_hospital == 9999) ? thisUser()->resident_hospital_etc : thisUser()->hospital('resident_hospital')->first()->hospital }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">레지던트수련기간</span></th>
                        <td colspan="3">{{ thisUser()->resident_sYear . '.' . thisUser()->resident_sMonth }} ~ {{ thisUser()->resident_eYear . '.' . thisUser()->resident_eMonth }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">세부전공</span></th>
                        <td colspan="3">{{ $userConfig['detail_major'][thisUser()->detail_major] ?? '' }}</td>
                    </tr>
                    <tr>
                        <th><span class="label">회원사진</span></th>
                        <td colspan="3">
                            @if(thisUser()->image_name)
                                <a href="{{ route('common.file.download', ['case' => 'user', 'type' => 'only', 'file_path' => base64_encode(thisUser()->image_path), 'file_name' => base64_encode(thisUser()->image_name)]) }}">
                                    {{ thisUser()->image_name }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>

                <h4 class="pointTit">근무처 정보</h4>
                <table class="tblDef rwTbl al">
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: *;">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th><span class="essen" title="필수">근무처 정보</span></th>
                        <td>{{ $userConfig['office'][thisUser()->office] }} {{ thisUser()->office_etc ?? '' }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">근무처 직위</span></th>
                        <td>
                            @php
                                $office_position = '';
                                foreach(json_decode(thisUser()->office_position) as $key => $row) {
                                    $office_position .= $userConfig['office_position'][$row] . ', ';

                                    if($row === 99) {
                                        $office_position_etc = thisUser()->office_position_etc;
                                    }
                                }
                            @endphp
                            {{ substr($office_position, 0, -2) . (empty($office_position_etc) ? '' : "({$office_position_etc})") }}
                        </td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">근무처명 (한글)</span></th>
                        <td>{{ thisUser()->office_name == 9999 ? thisUser()->office_name_etc : thisUser()->hospital('office_name')->first()->hospital }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">근무처명 (영문)</span></th>
                        <td>{{ thisUser()->office_name_en }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">주소</span></th>
                        <td>[{{ thisUser()->office_zipcode }}] {{ thisUser()->office_addr1 . ' ' . thisUser()->office_addr2 }}</td>
                    </tr>
                    <tr>
                        <th><label for="">근무처 영문 주소</label></th>
                        <td>{{ thisUser()->office_addr_en }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">병원소속</span></th>
                        <td>{{ thisUser()->sosok }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">전화번호</span></th>
                        <td>{{ thisUser()->office_tel }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">팩스번호</span></th>
                        <td>{{ thisUser()->office_fax }}</td>
                    </tr>
                    </tbody>
                </table>

                <h4 class="pointTit">자택정보</h4>
                <table class="tblDef rwTbl al">
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: *;">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th><span class="essen" title="필수">자택주소</span></th>
                        <td>[{{ thisUser()->zipcode }}] {{ thisUser()->addr1 . ' ' . thisUser()->addr2 }}</td>
                    </tr>
                    <tr>
                        <th><span class="label">자택전화</span></th>
                        <td>{{ thisUser()->tel }}</td>
                    </tr>
                    </tbody>
                </table>

                <h4 class="pointTit">경력사항</h4>
                <table class="tblDef rwTbl al">
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: *;">
                    </colgroup>
                    <tbody>
                    @foreach(json_decode(thisUser()->career) as $row)
                        <tr>
                            <th><span class="essen" title="필수">기간</span></th>
                            <td>
                                {{ $row->career_sYear . '.' . $row->career_sMonth }} ~
                                @if(($row->on_duty ?? 'N') === 'Y')
                                    근무중
                                @else
                                    {{ $row->career_eYear . '.' . $row->career_eMonth }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th><span class="essen" title="필수">근무처</span></th>
                            <td>{{ $row->career_office }}</td>
                        </tr>
                        <tr>
                            <th><span class="essen" title="필수">직위</span></th>
                            <td>{{ $row->career_position }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <h4 class="pointTit">기타</h4>
                <table class="tblDef rwTbl al">
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: *;">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th><span class="essen" title="필수">우편물 수령처</span></th>
                        <td>{{ $userConfig['receipt'][thisUser()->receipt] }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">이메일 수신</span></th>
                        <td>{{ thisUser()->email_yn === 'Y' ? '수신' : '수신거부' }}</td>
                    </tr>
                    <tr>
                        <th><span class="essen" title="필수">SMS 수신</span></th>
                        <td>{{ thisUser()->sms_yn === 'Y' ? '수신' : '수신거부' }}</td>
                    </tr>
                    </tbody>
                </table>

                <div class="btn btnArea">
                    <a href="javascript:void(0);" class="btnBig btnPoint" id="modify_init">수정</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        $(document).on('click', '#modify_init', function() {
            actionConfirmAlert('내정보를 수정 하시겠습니까?', {
                'ajax': actionAjax('{{ route('mypage.data') }}', {'case': 'modify-init'})
            });
        });

        $(document).on('click', '#modify_cancel', function() {
            actionConfirmAlert('내정보 수정을 취소 하시겠습니까?', {
                'ajax': actionAjax('{{ route('mypage.data') }}', {'case': 'modify-cancel'})
            });
        });
    </script>
@endsection
