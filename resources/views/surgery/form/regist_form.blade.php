<article class="sub-contents">
    <div class="sub-conbox intervention-conbox inner-layer">
        <div class="sub-tit-wrap">
            <h3 class="sub-tit">중재시술인증</h3>
        </div>
        <div class="write-form-wrap">
            <form action="{{ route('surgery.data')}}" method="post" id="register-frm" data-sid="{{$surgery->sid ?? 0}}" data-case="surgery-{{ empty($surgery->sid) ? 'create':'update'}}" enctype="multipart/form-data" onsubmit="return false;">
                <fieldset>
                    <legend class="hide">중재시술인증 등록</legend>
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
                        <a href="javascript:;" data-type="career" data-surgery_sid="{{$surgery->sid ?? 0}}" class="layer full-right btn btn-type1 color-type7">
                            <span class="plus">+</span> 경력 추가
                        </a>
                    </div>
                    <div class="table-wrap scroll-x touch-help">
                        <table class="cst-table">
                            <caption class="hide">경력</caption>
                            <colgroup>
                                <col style="width: 15%;">
                                <col>
                                <col style="width: 15%;">
                                <col>
                                <col style="width: 15%;">
                                <col style="width: 12%;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th scope="col">경력(구분)</th>
                                <th scope="col">기간</th>
                                <th scope="col">연구기관</th>
                                <th scope="col">내용</th>
                                <th scope="col">작성일</th>
                                <th scope="col">관리</th>
                            </tr>
                            </thead>
                            <tbody id="career_tbl">
                            @if(!empty($surgery->sid))
                                @foreach($surgery->careers as $career)
                                    <tr id="career_{{ $career->sid }}" data-sid="{{ $career->sid }}">
                                        <td>{{ $surgeryConfig['career_gubun'][$career->gubun]}}</td>
                                        <td>{{$career->sdate}} ~ {{$career->edate}}</td>
                                        <td>{{$career->title}}</td>
                                        <td>{{$career->content}}</td>
                                        <td>{{$career->created_at->format('Y-m-d')}}</td>
                                        <td>
                                            <div class="btn-admin">
                                                <a href="javascript:;" data-type="career" data-sid="{{ $career->sid ?? 0 }}" data-surgery_sid="{{ $surgery->sid ?? 0 }}" class="layer btn btn-board btn-modify">수정</a>
{{--                                                <a href="{{ route('surgery.career.register',['sid' => $career->sid]) }}" class="call_popup btn btn-board btn-modify" data-popup_name="surgery_career_regist" data-width="1000" data-height="800">수정</a>--}}
                                                <a href="javascript:;" class="career-delete btn btn-board btn-delete">삭제</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>

                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">주요논문 및 저서 정보</h4>
                        <ul class="list-type list-type-bar">
                            <li class="text-red">대한부정맥학회지(IJA-논문제목과 해당 호, 권 정보를 기입) 원저 1평(저자 혹은 교신저) 제출</li>
                        </ul>
                    </div>
                    <div class="write-wrap">
                        <dl>
                            <dt>주요논문 및 저서</dt>
                            <dd>
                                <div class="form-group">
                                    <input type="text" name="detail1" id="detail1" value="{{ $surgery->detail1 ?? '' }}" class="form-item">
                                </div>
                                <div class="form-group mt-10">
                                    <input type="text" name="detail2" id="detail2" value="{{ $surgery->detail2 ?? '' }}" class="form-item">
                                </div>
                                <div class="form-group mt-10">
                                    <input type="text" name="detail3" id="detail3" value="{{ $surgery->detail3 ?? '' }}" class="form-item">
                                </div>
                                <div class="form-group mt-10">
                                    <input type="text" name="detail4" id="detail4" value="{{ $surgery->detail4 ?? '' }}" class="form-item">
                                </div>
                                <div class="form-group mt-10">
                                    <input type="text" name="detail5" id="detail5" value="{{ $surgery->detail5 ?? '' }}" class="form-item">
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>기타</dt>
                            <dd>
                                <div class="form-group">
                                    <input type="text" name="etc1" id="etc1" value="{{ $surgery->etc1 ?? '' }}" class="form-item">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="etc2" id="etc2" value="{{ $surgery->etc2 ?? '' }}" class="form-item mt-10">
                                </div>
                            </dd>
                        </dl>
                    </div>

                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">추천서 제출</h4>
                        <ul class="list-type list-type-bar">
                            <li class="text-red">서명 혹은 날인된 2일(기 전문회원) 추천서의 스캔본을 업로드해주시기 바랍니다.</li>
                        </ul>
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
                                <input type="text" name="name1" id="name1" value="{{ $surgery->name1 ?? '' }}" class="form-item medium"> (예) 홍길동
                            </dd>
                        </dl>
                        <dl>
                            <dt>추천서 스캔본 (1)</dt>
                            <dd>
                                <div class="filebox">
                                    <input class="upload-name form-item" id="fileName1" name="fileName1" value="{{ $surgery->file1 ?? '' }}" placeholder="업로드" readonly="readonly">
                                    <label for="file1">파일 업로드</label>
                                    <input type="file" id="file1" name="file1" class="file_upload" value="" accept=".xls,.xlsx,.pdf,.hwp,.doc,.docx" data-accept="xls|xlsx|pdf|hwp|doc|docx" onchange="fileCheck(this,$('#fileName1'))" >
                                    @if(!empty($surgery->realfile1))
                                        <div class="attach-file">
                                            <a href="{{ $surgery->downloadFileUrl('realfile1', 'file1') }}" class="link">{{$surgery->file1}}</a>
                                        </div>
                                    @endif
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>추천자 성명 (2)</dt>
                            <dd>
                                <input type="text" name="name2" id="name2" value="{{ $surgery->name2 ?? '' }}" class="form-item medium"> (예) 홍길동
                            </dd>
                        </dl>
                        <dl>
                            <dt>추천서 스캔본 (2)</dt>
                            <dd>
                                <div class="filebox">
                                    <input class="upload-name form-item" id="fileName2" name="fileName2" value="{{ $surgery->file2 ?? '' }}" placeholder="업로드" readonly="readonly">
                                    <label for="file2">파일 업로드</label>
                                    <input type="file" id="file2" name="file2" class="file_upload" value="" accept=".xls,.xlsx,.pdf,.hwp,.doc,.docx" data-accept="xls|xlsx|pdf|hwp|doc|docx" onchange="fileCheck(this,$('#fileName2'))" >
                                    @if(!empty($surgery->realfile2))
                                        <div class="attach-file">
                                            <a href="{{ $surgery->downloadFileUrl('realfile2', 'file2') }}" class="link">{{$surgery->file2}}</a>
                                        </div>
                                    @endif
                                </div>
                            </dd>
                        </dl>
                    </div>

                    <div class="sub-contit-wrap">
                        <h4 class="sub-contit">증례 제출</h4>
                        <a href="javascript:;" data-type="case" data-surgery_sid="{{$surgery->sid ?? 0}}" class="layer full-right btn btn-type1 color-type17"><span class="plus">+</span> 증례 추가</a>
{{--                        <a href="{{ route('surgery.case.register') }}" class="call_popup full-right btn btn-type1 color-type17" data-popup_name="surgery_case_regist" data-width="1000" data-height="800" ><span class="plus">+</span> 증례 추가</a>--}}
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
                                <col style="width: 12%;">
                                <col style="width: 12%;">
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
                                <th scope="col">관리</th>
                            </tr>
                            </thead>
                            <tbody id="case_tbl">
                            @if(!empty($surgery->sid))
                                @foreach($surgery->cases as $case)
                                    <tr id="case_{{ $case->sid }}" data-sid="{{ $case->sid }}">
                                        <td>{{ $surgeryConfig['case_gubun'][$case->gubun]}}</td>
                                        <td>{{$case->name}}</td>
                                        <td>{{$case->age}}</td>
                                        <td>{{ $surgeryConfig['case_gender'][$case->gender]}}</td>
                                        <td>{{$case->num}}</td>
                                        <td>{{$case->title}}</td>
                                        <td>{{$case->date}}</td>
                                        <td>
                                            <div class="btn-admin">
                                                <a href="javascript:;" data-type="case" data-sid="{{ $case->sid ?? 0 }}" data-surgery_sid="{{ $surgery->sid ?? 0 }}" class="layer btn btn-board btn-modify">수정</a>
{{--                                                <a href="{{ route('surgery.case.register',['sid' => $case->sid]) }}" class="call_popup btn btn-board btn-modify" data-popup_name="surgery_case_regist" data-width="1000" data-height="800">수정</a>--}}
                                                <a href="javascript:;" class="case-delete btn btn-board btn-delete">삭제</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:;" id="register_cancel" onclick="closeWindow()" class="btn btn-type1 color-type4">취소</a>
                        <button type="submit" class="btn btn-type1 color-type18">{{ empty($surgery->sid) ? '등록':'수정'}}</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</article>