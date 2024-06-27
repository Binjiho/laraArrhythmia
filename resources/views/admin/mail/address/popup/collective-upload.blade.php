@extends('admin.layouts.pop-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/handsontable/css/handsontable.full.min.css') }}"/>
@endsection

@section('contents')
    <div style="padding: 15px;">
        <h1>명단 일괄등록</h1>

        <div class="popupCon">
            <div style="font-weight: bold; padding: 10px 0;">
                <p>* 아래 형식에 맞게 엑셀내용을 복사하여 붙여넣기 해주시기 바랍니다. (아래 한칸은 예시입니다.)</p>
                <p>* 빨간색으로 표기된 부분은 필수 값이니 꼭 입력해 주세요.</p>
            </div>

            <div class="formArea">
                <form method="post" action="{{ route('mail.address.list.data', ['ma_sid' => request()->ma_sid]) }}" id="collective-upload" data-case="collective-create" onsubmit="return false;">
                    <div style="width:100%;" >
                        <div id="handsontable" class="hot handsontable htRowHeaders htColumnHeaders" ></div>
                    </div>

                    <div class="btn btnArea">
                        <input type="submit" value="등록" class="btnBig btnOk">
                        <input type="button" value="취소" class="btnBig btnReset" onclick="window.close();">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/handsontable/js/handsontable.full.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#collective-upload';
        const rowHeader = "✚";
        const delimiter = '|::|';

        const handson = new Handsontable(document.getElementById('handsontable'), {
            colHeaders: ['이름', '이메일', '휴대폰번호'],
            colWidths: [150, 150, 150],
            data: [{
                name: '',
                name2: '',
                name3: '',
            }],
            licenseKey: 'non-commercial-and-evaluation',
            rowHeaders: "✚",
            contextMenu: true,
        });

        const exportPlugin = handson.getPlugin('exportFile');

        $(document).on('click', '#collective-upload input[type=submit]', function(e) {
            e.preventDefault();

            const resText = exportPlugin.exportAsString('csv', {
                exportHiddenRows: true,     // default false, exports the hidden rows
                exportHiddenColumns: true,  // default false, exports the hidden columns
                columnHeaders: false,        // default false, exports the column headers
                rowHeaders: true,           // default false, exports the row headers
                columnDelimiter: delimiter,       // default ',', the data delimiter
            });

            let obj = resText.split(rowHeader);
            obj.shift();

            let formData = [];
            let ajaxData = new FormData();
            let submitCheck = true;

            $.each(obj, function (key, data) {
                let excelData = data.split(delimiter);
                excelData.shift();

                excelData = {
                    'name': excelData[0],
                    'email': excelData[1],
                    'phone': excelData[2],
                }

                if(isEmpty(excelData.name)) {
                    submitCheck = false;
                    actionAlert({'msg': '이름을 입력해주세요.'});
                    return false;
                }

                if(isEmpty(excelData.email)) {
                    submitCheck = false;
                    actionAlert({'msg': '이메일을 입력해주세요.'});
                    return false;
                }

                if(isEmpty(excelData.phone)) {
                    submitCheck = false;
                    actionAlert({'msg': '휴대폰 번호를 입력해주세요.'});
                    return false;
                }

                formData.push(excelData)
            });

            if(submitCheck) {
                ajaxData.append('case', $(form).data('case'));
                ajaxData.append('data', JSON.stringify(formData));
                callMultiAjax($(form).attr('action'), ajaxData);
                // ajaxData.append('data', JSON.stringify(formData));
                // callMultiAjax($(form).attr('action'), ajaxData);
            }
        });
    </script>
@endsection
