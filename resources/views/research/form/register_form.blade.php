<form action="{{ route('research.data') }}" method="post" data-sid="{{ $research->sid ?? 0 }}" data-case="research-{{ empty($research->sid) ? 'create' : 'update' }}" id="register-frm" onsubmit="return false;" enctype="multipart/form-data">
            <fieldset>
                <legend class="hide">연구비 신청</legend>
                <div class="write-wrap">
                    <dl>
                        <dt>연구 과제명</dt>
                        <dd>
                            <input type="text" name="subject" id="subject" class="form-item" value="{{ $research->subject ?? '' }}">
                        </dd>
                    </dl>
                    <dl>
                        <dt>책임 연구자</dt>
                        <dd>
                            <input type="text" name="name" id="name" class="form-item" value="{{ $research->name ?? '' }}">
                        </dd>
                    </dl>
                    <dl>
                        <dt>연구기간</dt>
                        <dd>
                            <div class="form-group form-group-text n2">
                                <input type="text" name="sdate" id="sdate" class="form-item" value="{{ $research->sdate ?? '' }}" readonly datepicker>
                                <span class="text">-</span>
                                <input type="text" name="edate" id="edate" class="form-item" value="{{ $research->edate ?? '' }}" readonly datepicker>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>과제구분</dt>
                        <dd>
                            <div class="radio-wrap cst">
                                <div class="radio-group"><input type="radio" name="date_type" id="date_type" value="D" checked> <label for="date_type">1년 과제</label></div>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>총연구비</dt>
                        <dd>
                            <input type="text" name="tot_price" id="tot_price" class="form-item" value="{{ $research->tot_price ?? '' }}" onlyNumber>
                        </dd>
                    </dl>
                    <dl>
                        <dt>내용</dt>
                        <dd>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-item">{{ $research->content ?? '' }}</textarea>
                        </dd>
                    </dl>
                    <dl>
                        <dt>신청서</dt>
                        <dd>
                            <div class="filebox">
                                <input class="upload-name form-item" id="fileName1" name="fileName1" value="{{ $research->file_name1 ?? '' }}" placeholder="파일첨부">
                                <label for="file1">파일첨부</label>
                                <input type="file" id="file1" name="file1" class="file-upload">
                                @if (!empty($research->file_path1))
                                    <div class="attach-file">
                                        <a href="{{ $research->downloadFileUrl('file_path1', 'file_name1') }}" target="_blank" class="link">{{$research->file_name1}}</a>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('staticDownload',['file_name'=>'research.docx', 'file_path'=>'/assets/file/research.docx']) }}" target="_blank" class="btn btn-small color-type2">신청서 다운로드 <span class="arrow">&gt;</span></a>
                        </dd>
                    </dl>
                    <dl>
                        <dt>추천서</dt>
                        <dd>
                            <div class="filebox">
                                <input class="upload-name form-item" id="fileName2" name="fileName2" value="{{ $research->file_name2 ?? '' }}" placeholder="파일첨부">
                                <label for="file2">파일첨부</label>
                                <input type="file" id="file2" name="file2" class="file-upload">
                                @if (!empty($research->file_path2))
                                    <div class="attach-file">
                                        <a href="{{ $research->downloadFileUrl('file_path2', 'file_name2') }}" target="_blank" class="link">{{$research->file_name2}}</a>
                                    </div>
                                @endif
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>이력서</dt>
                        <dd>
                            <div class="filebox">
                                <input class="upload-name form-item" id="fileName3" name="fileName3" value="{{ $research->file_name3 ?? '' }}" placeholder="파일첨부">
                                <label for="file3">파일첨부</label>
                                <input type="file" id="file3" name="file3" class="file-upload">
                                @if (!empty($research->file_path3))
                                    <div class="attach-file">
                                        <a href="{{ $research->downloadFileUrl('file_path3', 'file_name3') }}" target="_blank" class="link">{{$research->file_name3}}</a>
                                    </div>
                                @endif
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>업무업적</dt>
                        <dd>
                            <div class="filebox">
                                <input class="upload-name form-item" id="fileName4" name="fileName4" value="{{ $research->file_name4 ?? '' }}" placeholder="파일첨부">
                                <label for="file4">파일첨부</label>
                                <input type="file" id="file4" name="file4" class="file-upload">
                                @if (!empty($research->file_path4))
                                    <div class="attach-file">
                                        <a href="{{ $research->downloadFileUrl('file_path4', 'file_name4') }}" target="_blank" class="link">{{$research->file_name4}}</a>
                                    </div>
                                @endif
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>연구계획서</dt>
                        <dd>
                            <div class="filebox">
                                <input class="upload-name form-item" id="fileName5" name="fileName5" value="{{ $research->file_name5 ?? '' }}" placeholder="파일첨부">
                                <label for="file5">파일첨부</label>
                                <input type="file" id="file5" name="file5" class="file-upload">

                                @if (!empty($research->file_path5))
                                    <div class="attach-file">
                                        <a href="{{ $research->downloadFileUrl('file_path5', 'file_name5') }}" target="_blank" class="link">{{$research->file_name5}}</a>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('staticDownload',['file_name'=>'연구계획서(2019).docx', 'file_path'=>'/assets/file/연구계획서(2019).docx']) }}" target="_blank" class="btn btn-small color-type2">연구계획서 다운로드 <span class="arrow">&gt;</span></a>
                        </dd>
                    </dl>
                </div>
                <div class="btn-wrap text-center">
                    <a href="javascript:;" onclick="closeWindow()" class="btn btn-type1 color-type4">취소</a>
                    <button type="submit" class="btn btn-type1 color-type5">{{ empty($research->sid) ? '등록' : '수정' }}</button>
                </div>
            </fieldset>
        </form>