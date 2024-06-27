@extends('admin.layouts.pop-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/handsontable/css/handsontable.full.min.css') }}"/>
@endsection

@section('contents')
    <div style="padding: 15px;">
        <div class="titArea">
            <h2>연구회 명단 다건 등록</h2>
        </div>

        <form method="post" action="{{ route('group.member.data', ['g_sid' => request()->g_sid]) }}" id="collective-upload" data-case="collective-create" onsubmit="return false;">
            <input type="hidden" name="g_sid" value="{{ request()->g_sid }}">
            <div style="width:100%;" >
                <div id="handsontable" class="hot handsontable htRowHeaders htColumnHeaders" ></div>
            </div>


            <div class="btn btnArea">
                <input type="submit" value="등록" class="btnBig btnOk">
                <input type="button" value="취소" class="btnBig btnReset" onclick="window.close();">
            </div>
        </form>
    </div>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/handsontable/js/handsontable.full.min.js') }}"></script>
    <script>
        const form = '#collective-upload';
        const rowHeader = "✚";
        const delimiter = '|::|';

        const handson = new Handsontable(document.getElementById('handsontable'), {
            colHeaders: ['직책', '아이디', '성명' , '소속'],
            colWidths: [150, 150, 150, 170],
            data: [{
                name: '',
                name2: '',
                name3: '',
                name4: '',
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
                    'position': excelData[0],
                    'uid': excelData[1],
                    'name_kr': excelData[2],
                    'sosok': excelData[3],
                }

                if(isEmpty(excelData.position)) {
                    submitCheck = false;
                    actionAlert({'msg': '직책을 입력해주세요.'});
                    return false;
                }

                if(isEmpty(excelData.uid)) {
                    submitCheck = false;
                    actionAlert({'msg': '아이디를 입력해주세요.'});
                    return false;
                }

                if(isEmpty(excelData.name_kr)) {
                    submitCheck = false;
                    actionAlert({'msg': '이름을 입력해주세요.'});
                    return false;
                }

                if(isEmpty(excelData.sosok)) {
                    submitCheck = false;
                    actionAlert({'msg': '소속을 입력해주세요.'});
                    return false;
                }

                formData.push(excelData);
            });

            if(submitCheck) {
                ajaxData.append('case', $(form).data('case'));
                ajaxData.append('data', JSON.stringify(formData));
                callMultiAjax($(form).attr('action'), ajaxData);
            }
        });
    </script>
@endsection
