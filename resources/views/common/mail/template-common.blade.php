@if((int)$data->template < 4 /* 템플릿없음, 템플릿 1, 템플릿 2 에만 제목 사용 */)
    <tr>
        <td style="padding: 45px 20px 0;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size:22px;font-weight: bold;line-height:1.2;text-align: center;color:#282828;letter-spacing: -1px;">
            {!! $data->subject !!}
        </td>
    </tr>
@endif

<tr>
    <td style="padding: 40px;color: #2a2a66;font-size: 14px;line-height: 25px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;">
        {!! $data->contents !!}
    </td>
</tr>

@if(!empty($data->file))
    <tr>
        <td style="text-align: left; padding: 20px;">
            @foreach(json_decode($data->file) as $row)
                @if($data->preview)
                    <a href="javascript:alert('미리보기중에는 다운로드 할 수 없습니다.')" style="display: block;border: 0 none;text-decoration: none;color: #000;outline: none;line-height: 20px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;">
                        <img src="{{ asset('assets/image/icon/bbs_attach.png') }}" alt="" style="display: inline-block;vertical-align: top;padding-right: 5px;height: 20px;">
                        <span style="display: inline-block;vertical-align: top;color: #000;text-decoration: none;">첨부파일: {{ $row->filename }}</span>
                    </a>
                @else
                    <a href="{{ $data->downloadFileUrl($row->realfile, $row->filename) }}" style="display: block;border: 0 none;text-decoration: none;color: #000;outline: none;line-height: 20px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;">
                        <img src="{{ asset('assets/image/icon/bbs_attach.png') }}" alt="" style="vertical-align: top;">
                        첨부파일: {{ $row->filename }}
                    </a>
                @endif
            @endforeach
        </td>
    </tr>
@endif

@if(!empty($data->use_btn))
    <tr>
        <td style="text-align: center; padding: 20px 225px;">
            @switch($data->use_btn)
                @case('1')
                    <a href="{{ $data->link_url }}" style="display: block;border:0 none" target="_blank">
                        <img src="{{ asset('assets/image/common/mailBtn.png') }}" alt="자세히보기" style="display: block;border:0 none;">
                    </a>
                    @break

                @case('2')
                    <a href="{{ $data->link_url }}" style="display: block;border:0 none;" target="_blank">
                        <img src="{{ asset('assets/image/common/mailBtn_home.png') }}" alt="홈페이지 바로가기" style="display: block;border:0 none;">
                    </a>
                    @break

                @default
                    @break
            @endswitch
        </td>
    </tr>
@endif
