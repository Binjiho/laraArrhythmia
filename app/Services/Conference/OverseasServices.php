<?php

namespace App\Services\Overseas;

use App\Models\Overseas;

use App\Services\CommonServices;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthServices
 * @package App\Services
 */
class OverseasServices extends AppServices
{
    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'overseas_regist-create':
                return $this->overseasRegistCreateServices($request);

            case 'overseas_regist-update':
                return $this->overseasRegistUpdateServices($request);

            default:
                return notFoundRedirect();
        }
    }

    private function overseasRegistCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = new Overseas();
            /**
             * 등록번호
             */
//            if(!$request->sid){
//                $regnum = sprintf("04d");
//            }
            $overseas->setBydata($request);
            $overseas->save();

            $this->dbCommit('연구비신청 생성');

//            return $this->returnJsonData('location', $this->ajaxActionLocation('reload'));
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '연구비신청이 등록 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
//            return $this->dbRollback($e,true);
        }
    }

    private function overseasRegistUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = Overseas::findOrFail($request->sid);

            // 회원사진 바로 삭제할수 있지만 DB update 실패시 사진 사라지면 안되서 변수로 임시 저장
            if ($request->file_del === 'Y') {
                $delete_file_path = $overseas->image_path;
            }

            $overseas->setBydata($request);
            $overseas->update();

            $this->dbCommit('연구비신청 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '연구비신청이 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
//            return $this->dbRollback($e,true);
        }
    }

    private function listUrl()
    {
        return route('overseas.info');
    }

}
