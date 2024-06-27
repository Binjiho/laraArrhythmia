{{--@extends('admin.layouts.pop-layout')--}}
@extends('layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('research.form.register_form')
@endsection

@section('addScript')
    <script>

        const form = '#register-frm';
        const dataUrl = '{{ route('research.data') }}';

        defaultVaildation();

        function closeWindow(){
            if (confirm('취소 하시겠습니까?')) {
                window.close();
            }
        }


        // 게시판 폼 체크
        $(form).validate({
            ignore: ['content', 'popup_content'],
            rules: {
                name: {
                    isEmpty: true,
                },
                subject: {
                    isEmpty: true,
                },
                tot_price: {
                    isEmpty: true,
                },
                date_type: {
                    isEmpty: true,
                },
                sdate: {
                    isEmpty: true,
                },
                edate: {
                    isEmpty: true,
                },
                content: {
                    isEmpty: true,
                },
                fileName1: {
                    isEmpty: true,
                },
                fileName2: {
                    isEmpty: true,
                },
                fileName3: {
                    isEmpty: true,
                },
                fileName4: {
                    isEmpty: true,
                },
                fileName5: {
                    isEmpty: true,
                },
            },
            messages: {
                name: {
                    isEmpty: '책임 연구자를 입력해주세요.',
                },
                subject: {
                    isEmpty: `연구 과제명을 입력해주세요.`,
                },
                tot_price: {
                    isEmpty: '총연구비를 입력해주세요.',
                },
                sdate: {
                    isEmpty: '연구기간 시작날짜를 선택해주세요.',
                },
                edate: {
                    isEmpty: '연구기간 마감날짜를 선택해주세요.',
                },
                content: {
                    isEmpty: '내용을 입력해주세요.',
                },
                fileName1: {
                    isEmpty: '신청서를 첨부해주세요.',
                },
                fileName2: {
                    isEmpty: '추천서를 첨부해주세요.',
                },
                fileName3: {
                    isEmpty: '이력서를 첨부해주세요.',
                },
                fileName4: {
                    isEmpty: '업무업적을 첨부해주세요.',
                },
                fileName5: {
                    isEmpty: '연구계획서를 첨부해주세요.',
                },
            },
            submitHandler: function() {

                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData(form);
            // ajaxData.append('content', tinymce.get('content').getContent());
            // ajaxData.append('popup_content', tinymce.get('popup_content').getContent());
            // ajaxData.append('plupload_file', JSON.stringify(plupladFile));

            // callMultiAjax(dataUrl, ajaxData);
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
