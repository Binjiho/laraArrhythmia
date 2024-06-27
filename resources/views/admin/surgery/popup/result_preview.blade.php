@extends('layouts.pop-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
@endsection

@section('contents')
    <div class="popup-wrap full" style="display: block;">
        <div class="popup-contents">
            <div class="popup-conbox popup-research-conbox">
                <div class="write-form-wrap">
                    <form action="{{ route('surgery.data')}}" method="post" id="register-frm" data-sid="{{ $surgery->sid ?? 0 }}" data-case="surgery-final-judge" enctype="multipart/form-data" onsubmit="return false;">
                        <fieldset>
                            <legend class="hide">심사하기</legend>
                            <div class="sub-contit-wrap mt-0">
                                <h4 class="sub-contit">기본정보</h4>
                            </div>
                            <div class="write-wrap">
                                <dl>
                                    <dt>ID (E-mail Address)</dt>
                                    <dd>
                                        {{ $user->uid ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>거주 국가</dt>
                                    <dd>
                                        {{ $country[$user->country ?? '']['cn'] ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>성명 (영문)</dt>
                                    <dd>
                                        {{ $user->last_name ?? '' }} {{ $user->first_name ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>성명 (국문)</dt>
                                    <dd>
                                        {{$user->name_kr ?? ''}}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>증명사진</dt>
                                    <dd>
                                        @if($user->image_path)
                                            {{$user->image_name ?? ""}}
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>소속</dt>
                                    <dd>
                                        국문 : {{$user->sosok_kr ?? ""}} <br>
                                        영문 : {{$user->sosok_en ?? ""}}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>부서 (학과명)</dt>
                                    <dd>
                                        국문 : {{$user->depart_kr ?? ""}} <br>
                                        영문 : {{$user->depart_en ?? ""}}
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
                                    <dt>근무처 구분</dt>
                                    <dd>
                                        {{ $userConfig['office'][$user->office ?? ''] }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>가입 구분</dt>
                                    <dd>
                                        {{ $userConfig['category'][$user->category ?? ''] }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>전공 구분</dt>
                                    <dd>
                                        {{ $userConfig['major'][$user->major ?? ''] }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>출신 대학</dt>
                                    <dd>
                                        {{ $user->university ?? '' }} {{ $user->university_year ? '/ 졸업연도 : '.$user->university_year : '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>최종학위</dt>
                                    <dd>
                                        {{ $user->degree ?? '' }} {{ $user->degree_year ? '/ 취득연도 : '.$user->degree_year : '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>최정학위 논문 제목</dt>
                                    <dd>
                                        {{ $user->degree_title ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>면허번호</dt>
                                    <dd>
                                        {{ $user->license_number ?? '' }} {{ $user->license_year ? ' / 취득연도 : '.$user->license_year : '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>전문의 1</dt>
                                    <dd>
                                        @if($user->major1)
                                            {{ $user->major1 ?? '' }} {{ $user->major1_year ? ' / 취득연도 : '.$user->major1_year : '' }}
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>전문의 2</dt>
                                    <dd>
                                        @if($user->major2)
                                            {{ $user->major2 ?? '' }} {{ $user->major2_year ? ' / 취득연도 : '.$user->major2_year : '' }}
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>분과 전문의</dt>
                                    <dd>
                                        @if($user->speciality)
                                            {{ $user->speciality ?? '' }} {{ $user->speciality_year ? ' / 취득연도 : '.$user->speciality_year : '' }}
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>전공 분야</dt>
                                    <dd>
                                        {{ $user->major_field ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>진료 분야</dt>
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
                                <h4 class="sub-contit">경력</h4>
                            </div>
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">경력</caption>
                                    <colgroup>
                                        <col style="width: 15%;">
                                        <col>
                                        <col style="width: 15%;">
                                        <col>
                                        <col style="width: 18%;">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">경력(구분)</th>
                                        <th scope="col">기간</th>
                                        <th scope="col">연구기관</th>
                                        <th scope="col">내용</th>
                                        <th scope="col">작성일</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($surgery->careers as $career)
                                        <tr>
                                            <td>{{ $surgeryConfig['career_gubun'][$career->gubun]}}</td>
                                            <td>{{$career->sdate}} ~ {{$career->edate}}</td>
                                            <td>{{$career->title}}</td>
                                            <td>{{$career->content}}</td>
                                            <td>{{$career->created_at->format('Y-m-d')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">추천서 제출</h4>
                            </div>
                            <div class="write-wrap">
                                <dl>
                                    <dt>추천서 양식 다운로드</dt>
                                    <dd>
                                        <a href="{{ route('staticDownload',['file_name'=>'부정맥_중재시술_전문의_추천서.docx', 'file_path'=>'/assets/file/부정맥_중재시술_전문의_추천서.docx']) }}" class="btn btn-small color-type2">추천서 양식 다운로드</a>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>추천자 성명 (1)</dt>
                                    <dd>
                                        {{ $surgery->name1 ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>추천서 스캔본 (1)</dt>
                                    <dd>
                                        @if(!empty($surgery->realfile1))
                                            <div class="attach-file">
                                                <a href="{{ $surgery->downloadFileUrl('realfile1', 'file1') }}" class="link">{{$surgery->file1}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>추천자 성명 (2)</dt>
                                    <dd>
                                        {{ $surgery->name2 ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>추천서 스캔본 (2)</dt>
                                    <dd>
                                        @if(!empty($surgery->realfile2))
                                            <div class="attach-file">
                                                <a href="{{ $surgery->downloadFileUrl('realfile2', 'file2') }}" class="link">{{$surgery->file2}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">증례 제출</h4>
                            </div>
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">증례 제출</caption>
                                    <colgroup>
                                        <col style="width: 15%;">
                                        <col style="width: 12%;">
                                        <col style="width: 10%;">
                                        <col style="width: 10%;">
                                        <col style="width: 15%;">
                                        <col>
                                        <col style="width: 15%;">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">구분</th>
                                        <th scope="col">환자명</th>
                                        <th scope="col">나이</th>
                                        <th scope="col">성별</th>
                                        <th scope="col">벙록번호</th>
                                        <th scope="col">진단명</th>
                                        <th scope="col">시술일</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($surgery->cases as $case)
                                        <tr>
                                            <td>{{ $surgeryConfig['case_gubun'][$case->gubun]}}</td>
                                            <td>{{$case->name}}</td>
                                            <td>{{$case->age}}</td>
                                            <td>{{ $surgeryConfig['case_gender'][$case->gender]}}</td>
                                            <td>{{$case->num}}</td>
                                            <td>{{$case->title}}</td>
                                            <td>{{$case->date}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">주요논문 및 저서 정보</h4>
                            </div>
                            <div class="write-wrap">
                                <dl>
                                    <dt>주요논문 및 저서</dt>
                                    <dd>
                                        {{ $surgery->detail1 ?? '' }} <br>
                                        {{ $surgery->detail2 ?? '' }} <br>
                                        {{ $surgery->detail3 ?? '' }} <br>
                                        {{ $surgery->detail4 ?? '' }} <br>
                                        {{ $surgery->detail5 ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>기타</dt>
                                    <dd>
                                        {{ $surgery->etc1 ?? '' }} <br>
                                        {{ $surgery->etc2 ?? '' }}
                                    </dd>
                                </dl>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">최종심사현황</h4>
                            </div>
                            <div class="write-wrap">
                                <dl>
                                    <dt>심사구분</dt>
                                    <dd>
                                        {{ $surgery->renewal == 'Y' ? '갱신': '신규' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>심사등록코드</dt>
                                    <dd>
                                        {{ $surgery->regnum ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>갱신되는코드</dt>
                                    <dd>
                                        <input type="text" name="mregnum" id="mregnum" value="{{ $surgery->mregnum ?? '' }}">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>부정맥중재시술인증 일자</dt>
                                    <dd>
                                        <input type="text" name="certi_date" id="certi_date" class="" value="{{ ($surgery->certi_date && isValidTimestamp($surgery->certi_date) ) ? $surgery->certi_date->format('Y-m-d') : '' }}" readonly datepicker>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>부정맥중재시술인증 갱신 예정일자</dt>
                                    <dd>
                                        {{ ($surgery->renewal ?? 'N') == 'Y' ? $surgery->renewal_date->format('Y-m-d') : '미인증' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>부정맥중재시술인증 여부</dt>
                                    <dd>
                                        <div class="radio-wrap cst">
                                            <div class="radio-group">
                                                <input type="radio" name="certi" id="certiY" value="Y" {{ $surgery->certi == 'Y' ? 'checked' : '' }}>
                                                <label for="certiY">승인</label>
                                            </div>
                                            <div class="radio-group">
                                                <input type="radio" name="certi" id="certiN" value="N" {{ $surgery->certi == 'N' ? 'checked' : '' }}>
                                                <label for="certiN">미승인</label>
                                            </div>
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>인증서</dt>
                                    <dd>
                                        <div class="filebox">
                                            <input class="upload-name form-item" id="fileName3" name="fileName3" value="{{ $surgery->file3 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                                            <label for="file3">파일첨부</label>
                                            <input type="file" id="file3" name="file3" class="file-upload" value="" accept=".pdf" data-accept="pdf" onchange="fileCheck(this,$('#fileName3'))">
                                            @if (!empty($surgery->realfile3))
                                                <div class="attach-file">
                                                    <a href="{{ $surgery->downloadFileUrl('realfile3', 'file3') }}" class="link">{{$surgery->file3}}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </dd>
                                </dl>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">심사내용</h4>
                            </div>
                            <div class="table-wrap scroll-x touch-help">
                                <table class="cst-table">
                                    <caption class="hide">심사내용</caption>
                                    <colgroup>
                                        <col style="width: 15%;">
                                        <col style="width: 15%;">
                                        <col>
                                        <col style="width: 10%;">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">심사자</th>
                                        <th scope="col">승인여부</th>
                                        <th scope="col">심사평</th>
                                        <th scope="col">관리</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($result as $row)
                                        <tr>
                                            <td>
                                                {{ $row->reviewer_info($row->reviewer_sid)->name_kr ?? '' }}
                                            </td>
                                            <td>{{ $row->certi =='Y' ? '승인':'미승인' }}</td>
                                            <td>{{ $row->memo ?? '' }}</td>
                                            <td>
                                                <div class="btn-admin">
                                                    <a href="javascript:;" onclick="delete_result({{ $row->sid }})" class="btn btn-board btn-delete">삭제</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">심사된 내역이 없습니다.</td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>

                            <div class="btn-wrap text-center">
                                <a href="javascript:;" onclick="self.close();" class="btn btn-type1 color-type4">닫기</a>
                                <a href="javascript:;" onclick="alert_post();" class="btn btn-type1 color-type18">등록</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#register-frm';
        const dataUrl = "{{ route('surgery.data') }}";

        defaultVaildation();

        function delete_result(el){
            if(confirm("심사자의 데이터를 정말로 삭제하시겠습니까?")){
                callAjax(dataUrl, {
                    'case': 'result-delete',
                    'sid': el,
                });
            }else{
                return false;
            }
        }

        function alert_post(){
            if(confirm("최종심사를 완료하시겠습니까?")){
                $("#register-frm").submit();
            }else{
                return false;
            }
        }

        defaultVaildation();

        $(form).validate({
            rules: {
                certi: {
                    checkEmpty: true,
                },
            },
            messages: {
                certi: {
                    checkEmpty: '승인유무를 입력해주세요.',
                },
            },
            submitHandler: function () {
                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData(form);
            callMultiAjax(dataUrl, ajaxData);
        }

    </script>
@endsection
