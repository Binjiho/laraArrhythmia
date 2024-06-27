@extends('admin.layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('surgery.form.regist_form')
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('surgery.data') }}';

        defaultVaildation();

        function closeWindow(){
            if (confirm('취소 하시겠습니까?')) {
                window.close();
            }
        }

        $(document).on('click', '.layer', function(){
            callAjax(dataUrl, {case: 'open-layer', type: $(this).data('type'), sid: $(this).data('sid'), surgery_sid: $(this).data('surgery_sid'), });
        });

        $(document).on('click', '.career-delete', function() {
            if(confirm('해당 경력을 삭제하시겠습니까?')){
                let _career_sid = $(this).closest('tr').data('sid');
                callAjax(dataUrl, { case: 'career-delete', sid: _career_sid} );
            }else{
                return false;
            }
        });

        $(document).on('click', '.case-delete', function() {
            if(confirm('해당 증례를 삭제하시겠습니까?')){
                let _case_sid = $(this).closest('tr').data('sid');
                callAjax(dataUrl, { case: 'case-delete', sid: _case_sid} );
            }else{
                return false;
            }
        });

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
            //경력 career
            let career_arr = [];
            $("#career_tbl tr").each(function (idx, item){
                career_arr.push($(item).data('sid'));
            });
            ajaxData.append('career_arr',career_arr);

            //증례 case
            let case_arr = [];
            $("#case_tbl tr").each(function (idx, item){
                case_arr.push($(item).data('sid'));
            });
            ajaxData.append('case_arr',case_arr);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

    <script>
        const careerForm = '#career-frm';

        // 게시글 작성 취소
        $(document).on('click', '#career_cancel', function(e) {
            e.preventDefault();

            const msg = ($(careerForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                // self.close();

                var $obj = $("#layer_pop");
                $("iframe",$obj).attr("src","");
                $obj.remove();
            }
        });


        $(form).validate({
            rules: {
                gubun: {
                    checkEmpty: true,
                },
                sdate: {
                    isEmpty: true,
                },
                edate: {
                    isEmpty: true,
                },
                title: {
                    isEmpty: true,
                },
                content: {
                    isEmpty: true,
                },
            },
            messages: {
                gubun: {
                    checkEmpty: '구분을 체크해주세요.',
                },
                sdate: {
                    isEmpty: '기간 시작일을 입력해주세요.',
                },
                edate: {
                    isEmpty: '기간 마감일을 입력해주세요.',
                },
                title: {
                    isEmpty: '기관명을 입력해주세요.',
                },
                content: {
                    isEmpty: '내용을 입력해주세요.',
                },
            },
            submitHandler: function () {
                careerSubmit();
            }
        });

        const careerSubmit = () => {
            let ajaxData = newFormData(form);
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
