<div class="programs_tbl">
    <input type="hidden" name="program_sid[]" value="" readonly>
    <dl>
        <dt class="text-right">
            <div class="btn-admin">
                <a href="javascript:;" onclick="change_tr(this,'del');" class="btn btn-board btn-delete">삭제</a>
            </div>
            {{--                                            <a href="#n" class="btn btn-small btn-board btn-delete">삭제</a>--}}
        </dt>
    </dl>
    <dl>
        <dt><strong class="required">*</strong> 세션 선택</dt>
        <dd>
            <select name="ssid[]" id="ssid" class="form-item">
                <option value="">선택</option>
                @foreach($session_list as $session_item)
                    <option value="{{ $session_item->sid }}">{{ $session_item->title }}</option>
                @endforeach
            </select>
        </dd>
    </dl>
    <dl>
        <dt>프로그램 시간</dt>
        <dd>
            <input type="text" name="time[]" id="time" class="form-item" value="">
        </dd>
    </dl>
    <dl>
        <dt><strong class="required">*</strong> 주제</dt>
        <dd>
            <input type="text" name="title[]" id="title" class="form-item" value="">
        </dd>
    </dl>
    <dl>
        <dt>연자이름 (소속)</dt>
        <dd>
            <input type="text" name="speaker[]" id="speaker" class="form-item" value="">
        </dd>
    </dl>
    <dl>
        <dt>강의자료</dt>
        <dd>
            <div class="filebox">
                <input class="upload-name form-item" id="fileName{{ $i }}" name="fileName{{ $i }}" value="" placeholder="업로드" readonly="readonly">
                <label for="file{{ $i }}">파일 업로드</label>
                <input type="file" id="file{{ $i }}" name="file{{ $i }}" class="file_upload" value="" accept=".word,.pdf,.hwp" data-accept="word|pdf|hwp" onchange="fileCheck(this,$('#fileName{{ $i }}') )" >
            </div>

        </dd>
    </dl>
    <dl>
        <dt>동영상 링크</dt>
        <dd>
            <input type="text" name="link_url[]" id="link_url" class="form-item" value="">
        </dd>
    </dl>
</div>