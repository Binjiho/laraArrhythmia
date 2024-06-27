@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        @include('surgery.form.regist_form')
    </article>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('surgery.data') }}';

        function closeWindow(){
            actionConfirmAlert('등록 취소하시겠습니까?', {
                'location': {
                    'case': 'replace',
                    'url': '{{route('surgery')}}',
                }
            });
        }

        $(document).on('click', '.layer', function(){
            callAjax(dataUrl, {case: 'open-layer', type: $(this).data('type'), sid: $(this).data('sid'), surgery_sid: $(this).data('surgery_sid'), });
        });

        $(document).on('click', '.career-delete', function() {
            if(confirm('해당 경력을 삭제하시겠습니까?')){
                let _career_sid = $(this).closest('tr').data('sid');
                console.log($(this).closest('tr').data('sid'));
                callAjax(dataUrl, { case: 'career-delete', sid: _career_sid} );
            }else{
                return false;
            }
        });

        $(document).on('click', '.case-delete', function() {
            if(confirm('해당 증례를 삭제하시겠습니까?')){
                let _case_sid = $(this).closest('tr').data('sid');
                console.log($(this).closest('tr').data('sid'));
                callAjax(dataUrl, { case: 'case-delete', sid: _case_sid} );
            }else{
                return false;
            }
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                title: {
                    isEmpty: true,
                },
            },
            messages: {
                title: {
                    isEmpty: '논문제목을 입력해주세요.',
                },

            },
            submitHandler: function () {
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

@endsection