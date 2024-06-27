@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="bbsView">
            <h4>{{ $reply->subject }}</h4>

            <table>
                <colgroup>
                    <col style="width: 20%;">
                    <col style="width: 30%;">
                    <col style="width: 20%;">
                    <col style="width: 30%;">
                </colgroup>

                <tbody>
                <tr>
                    <th>작성일</th>
                    <td>{{ $reply->created_at->format('Y.m.d') }}</td>
                    <th>조회수</th>
                    <td>{{ number_format($reply->ref) }}</td>
                </tr>

                @if($boardConfig['use']['file'] && !empty($reply->file_path))
                    <tr>
                        <th>{{ $boardConfig['file']['name'] }}</th>
                        <td colspan="3">
                            <a href="{{ $reply->downloadUrl() }}">
                                {{ $reply->file_name }} ({{ number_format($reply->download) }})
                            </a>
                        </td>
                    </tr>
                @endif

                @if($boardConfig['use']['plupload'] && $reply->files_count > 0)
                    <tr>
                        <th>첨부파일</th>
                        <td colspan="3">
                            @foreach($reply->files as $file)
                                <a href="{{ $file->downloadUrl() }}">
                                    {{ $file->file_name }}  (다운 : {{ number_format($file->download) }})
                                </a>
                            @endforeach
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="bbsCon">{!! $reply->contents !!}</div>
        </div>
        <!-- //bbs -->

        <div class="bbsUtil">
            <div class="btn">
                <a href="{{ route('board', ['code' => $code]) }}" class="list">
                    <img src="/image/icon/icon_list.png" alt="">목록
                </a>

                @if(isAdmin() || thisPk() == $reply->u_sid)
                    <a href="{{ route('board.reply.upsert', ['code' => $code, 'b_sid' => $b_sid, 'sid' => $reply->sid]) }}">
                        <img src="/image/icon/icon_upload.png" alt="">수정
                    </a>

                    <a href="javascript:void(0);" id="reply-del">삭제</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    @include("board.{$boardConfig['skin']}.script.default-script")

    <script>
        $(document).on('click', '#reply-del', function() {
            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax(dataUrl, { case: 'reply-delete', sid: {{ $reply->sid }} });
            }
        });
    </script>
@endsection
