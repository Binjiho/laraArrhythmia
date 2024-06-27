@extends('admin.layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    <div style="padding: 15px;">
        <div class="titArea">
            <h2>명단 {{ empty($member->sid) ? '등록' : '수정' }}</h2>
        </div>

        <form id="member-frm" data-sid="{{ $member->sid ?? 0 }}" data-case="member-{{ empty($member->sid) ? 'create' : 'update' }}" onsubmit="return false;">
            <fieldset>
                <table class="tblDef listTbl">
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: *;">
                    </colgroup>

                    <tbody>
                    <tr>
                        <th>직책</th>
                        <td>
                            <input type="text" name="position" value="{{ $member->position ?? '' }}" >
                        </td>
                    </tr>

                    <tr>
                        <th>아이디</th>
                        <td>
                            <input type="text" name="uid" value="{{ $member->uid ?? '' }}" readonly style="width: 70%;">
                            <div class="util btn">
                                <a href="javascript:serchLayer();" class="btnBdNavy">
                                    검색
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th>성명</th>
                        <td>
                            <input type="text" name="name_kr" value="{{ $member->name_kr ?? '' }}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th>소속</th>
                        <td>
                            <input type="text" name="sosok" value="{{ $member->sosok ?? '' }}">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </fieldset>

            <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                <a href="javascript:window.close();" class="btnBdBlue">닫기</a>
                <input class="btnDel" type="submit" value="{{ empty($member->sid) ? '등록' : '수정' }}">
            </div>
        </form>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('group.member.data', ['g_sid' => request()->g_sid]) }}';
        const groupFrm = '#member-frm';

        const serchLayer = () => {
            callAjax(dataUrl, {case: 'search-layer'});
        }

        $(document).on('submit', '#search-frm', function(e) {
            e.preventDefault();

            if (isEmpty($('#search-frm select[name=keyfield]').val())) {
                alert('검색조건을 선택해주세요.');
                return false;
            }

            if (isEmpty($('#search-frm input[name=keyword]').val())) {
                alert('검색어를 입력해주세요.');
                return false;
            }

            callAjax(dataUrl, formSerialize('#search-frm'));
        });

        $(document).on('click', '.select-member', function() {
            callAjax(dataUrl, {
                'case': 'select-member',
                'sid': $(this).closest('tr').data('sid'),
            });
        });

        defaultVaildation();

        $(groupFrm).validate({
            rules: {
                position: {
                    isEmpty: true,
                },
                uid: {
                    isEmpty: true,
                },
                name_kr: {
                    isEmpty: true,
                },
                sosok: {
                    isEmpty: true,
                },
            },
            messages: {
                position: {
                    isEmpty: '직책을 입력해주세요.',
                },
                uid: {
                    isEmpty: '아이디를 입력해주세요.',
                },
                name_kr: {
                    isEmpty: '이름을 입력해주세요.',
                },
                sosok: {
                    isEmpty: '소속을 입력해주세요.',
                },
            },
            submitHandler: function() {
                callAjax(dataUrl, formSerialize(groupFrm));
            }
        });
    </script>
@endsection
