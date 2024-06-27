@extends('layouts.pop-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
@endsection

@section('contents')
    <div class="popup-wrap full" style="display: block;">
        <div class="popup-contents">
            <div class="popup-conbox popup-research-conbox">
                <div class="write-form-wrap">
                    <form action="{{ route('surgery.data')}}" method="post" id="register-frm" data-sid="{{$result->sid ?? 0}}" data-case="surgery-judge" enctype="multipart/form-data" onsubmit="return false;">
                    <input type="hidden" name="state" id="state" value="N">
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
                                <h4 class="sub-contit">심사하기</h4>
                            </div>
                            <div class="write-wrap">
                                <dl>
                                    <dt>심사하기</dt>
                                    <dd>
                                        <div class="radio-wrap cst">
                                            <div class="radio-group">
                                                <input type="radio" name="certi" id="certi1" value="Y" {{ $result->certi == 'Y' ? 'checked' : '' }}>
                                                <label for="certi1">승인</label>
                                            </div>
                                            <div class="radio-group">
                                                <input type="radio" name="certi" id="certi2" value="N" {{ $result->certi == 'N' ? 'checked' : '' }}>
                                                <label for="certi2">미승인</label>
                                            </div>
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>심사평</dt>
                                    <dd>
                                        <textarea name="memo" id="memo" cols="30" rows="10" class="form-item">{{ $result->memo ?? '' }}</textarea>
                                    </dd>
                                </dl>
                            </div>

                            <div class="btn-wrap text-center">
                                <a href="javascript:;" onclick="alert_imsi()" class="btn btn-type1 color-type18">등록</a>
                                <a href="javascript:;" onclick="alert_complete()" class="btn btn-type1 color-type13">심사완료</a>
                                <a href="javascript:;" onclick="self.close();" class="btn btn-type1 color-type4">닫기</a>
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

        function alert_imsi(){
            if(confirm("등록 하시겠습니까? 심사 최종 제출을 원하시는 경우 심사완료 버튼을 클릭해 주셔야 심사가 완료됩니다.")){
                $("#state").val('N');
                $("#register-frm").submit();
            }else{
                return false;
            }
        }

        function alert_complete(){
            if(confirm("심사를 완료 하시겠습니까? 이후 심사 내용은 수정하실 수 없습니다.")){
                $("#state").val('Y');
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
