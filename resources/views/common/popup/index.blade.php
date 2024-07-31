@foreach($popup ?? [] as $row)
    <div class="popup-main popup-wrap full skin0{{ $row->popup_skin }}" style="top: {{ $row->popup_position_y }}px; left: {{ $row->popup_position_x }}px; width: {{ $row->popup_width }}px; height: {{ $row->popup_height }}px; display: block;" id="popup_{{ $row->sid }}">
        <div class="popup-contents">
            <div class="popup-conbox">

                <div class="popup-tit-wrap">
                    <h3 class="popup-tit">
                        {!! $row->subject !!}
                    </h3>
                </div>

        <!-- content -->
                <div class="view-contents editor-contents">

                {!! $row->content ?? $row->popup_contents !!}

                    @if($row->popup_detail === "Y")
                        <div class="btnArea btn">
                            <a href="{{ $row->popup_linkurl ?? '' }}" class="btnPoint" target="blank" title="새 창 열림">자세히 보기</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- //content -->

        <!-- popClose -->
        <div class="popup-footer">
            <div class="checkbox-wrap">
                <input type="checkbox" name="popup_yn" id="popup_yn_{{ $row->sid }}" value="Y">
                <label for="popup_yn_{{ $row->sid }}">오늘 하루 보지 않기</label>
            </div>
            <a href="#n" class="popup_close_btn full-right" data-sid="{{ $row->sid }}">닫기 X</a>
        </div>
        <!-- //popClose -->
    </div>
@endforeach
