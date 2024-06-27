@extends('layouts.pop-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
@endsection

@section('contents')
    <div class="popup-wrap full" style="display: block;">
        <div class="popup-contents">
            <div class="popup-conbox popup-research-conbox">
                <div class="write-form-wrap">
                    <form action="{{ route('research.data') }}" method="post" data-case="research-result-create" id="register-frm" onsubmit="return false;" enctype="multipart/form-data">
                        <fieldset>
                            <legend class="hide">심사하기</legend>
                            <div class="write-wrap">
                                <dl>
                                    <dt>연구 과제명</dt>
                                    <dd>
                                        {{ $research->subject ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>책임 연구자</dt>
                                    <dd>
                                        {{ $research->name ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>연구기간</dt>
                                    <dd>
                                        {{ $research->sdate ?? '' }} - {{ $research->edate ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>과제구분</dt>
                                    <dd>
                                        1년 과제
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>총연구비</dt>
                                    <dd>
                                        {{ $research->tot_price ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>내용</dt>
                                    <dd>
                                        {!! $research->content ?? '' !!}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>신청서</dt>
                                    <dd>
                                        @if (!empty($research->file_path1))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path1', 'file_name1') }}" class="link">{{$research->file_name1}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>추천서</dt>
                                    <dd>
                                        @if (!empty($research->file_path2))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path2', 'file_name2') }}" class="link">{{$research->file_name2}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>이력서</dt>
                                    <dd>
                                        @if (!empty($research->file_path3))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path3', 'file_name3') }}" class="link">{{$research->file_name3}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>업무업적</dt>
                                    <dd>
                                        @if (!empty($research->file_path4))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path4', 'file_name4') }}" class="link">{{$research->file_name4}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>연구계획서</dt>
                                    <dd>
                                        @if (!empty($research->file_path5))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path5', 'file_name5') }}" class="link">{{$research->file_name5}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">결과보고</h4>
                            </div>
                            <div class="write-wrap">
                                <dl>
                                    <dt>중간보고</dt>
                                    <dd>
                                        @if (!empty($research->file_path6))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path6', 'file_name6') }}" class="link">{{$research->file_name6}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>결과보고</dt>
                                    <dd>
                                        @if (!empty($research->file_path7))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path7', 'file_name7') }}" class="link">{{$research->file_name7}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">심사내용</h4>
                            </div>
                            <div class="table-wrap write-wrap">
                                <table class="cst-table">
                                    <caption class="hide">심사내용</caption>
                                    <colgroup>
                                        <col style="width: 10%;">
                                        <col style="width: 15%;">
                                        <col style="width: 15%;">
                                        <col style="width: 15%;">
                                        <col style="width: 15%;">
                                        <col style="width: 15%;">
                                        <col style="width: 10%;">
                                        <col style="width: 10%;">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">항목</th>
                                        <th scope="col">연구자의 연구력(논문)</th>
                                        <th scope="col">연구계획의 실현가능성</th>
                                        <th scope="col">연구계획의 논리/학문적 중요성</th>
                                        <th scope="col">연구방법의 적절성/윤리성(IRB)</th>
                                        <th scope="col">연구비 예산의 적절성</th>
                                        <th scope="col">총점</th>
                                        <th scope="col">평균</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $tot_score1 = $tot_score2 = $tot_score3 = $tot_score4 = $tot_score5 = 0;
                                    @endphp

                                    @forelse($result as $row)
                                        @php
                                        $tot_score1 += (int)$row->score1;
                                        $tot_score2 += (int)$row->score2;
                                        $tot_score3 += (int)$row->score3;
                                        $tot_score4 += (int)$row->score4;
                                        $tot_score5 += (int)$row->score5;
                                        @endphp
                                    <tr>
                                        <td>
                                            {{ $row->reviewer_info($row->reviewer_sid)->name_kr ?? '' }}
                                            @if(isAdmin())
                                            <br>
                                            <a href="javascript:;" class="btnSmall btnGrey2 btn-del" onclick="delete_result({{ $row->sid }})" >삭제</a>
                                            @endif
                                        </td>
                                        <td>{{ $row->score1 }}</td>
                                        <td>{{ $row->score2 }}</td>
                                        <td>{{ $row->score3 }}</td>
                                        <td>{{ $row->score4 }}</td>
                                        <td>{{ $row->score5 }}</td>
                                        <td>{{ $row->tot_score }}</td>
                                        <td>{{ $row->tot_avg }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">심사된 내역이 없습니다.</td>
                                        </tr>
                                    @endforelse

                                    @if($result->count() > 0)
                                    <tr>
                                        <td>평균</td>
                                        <td> {{ number_format($tot_score1/$result->count(),1) }} </td>
                                        <td> {{ number_format($tot_score2/$result->count(),1) }} </td>
                                        <td> {{ number_format($tot_score3/$result->count(),1) }} </td>
                                        <td> {{ number_format($tot_score4/$result->count(),1) }} </td>
                                        <td> {{ number_format($tot_score5/$result->count(),1) }} </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif

                                    </tbody>

                                </table>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">심사평</h4>
                            </div>
                            <div class="table-wrap write-wrap">
                                <table class="cst-table">
                                    <caption class="hide">심사내용</caption>
                                    <colgroup>
                                        <col style="width: 10%;">
                                        <col style="width: *%;">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">이름</th>
                                        <th scope="col">심사평</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($result as $row)
                                        <tr>
                                            <td>
                                                {{ $row->reviewer_info($row->reviewer_sid)->name_kr ?? '' }}
                                            </td>
                                            <td>{!! $row->memo !!}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">심사된 내역이 없습니다.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>

                                </table>
                            </div>

                            <div class="btn-wrap text-center">
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
        const dataUrl = "{{ route('research.data') }}";

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

        // $(document).on('click', $(".btn-del"), function() {
        //     const uid = $('input[name=uid]').val();
        //
        //
        // });

    </script>
@endsection
