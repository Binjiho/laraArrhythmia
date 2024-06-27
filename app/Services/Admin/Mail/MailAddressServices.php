<?php

namespace App\Services\Admin\Mail;

use App\Models\MailAddress;
use App\Models\MailAddressList;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class MailAddressServices
 * @package App\Services
 */
class MailAddressServices extends AppServices
{
    public function findMailAddress(int $sid = 0)
    {
        return MailAddress::findOrFail($sid);
    }

    public function addressService(Request $request)
    {
        $query = MailAddress::withCount('list')->orderByDesc('created_at');

        if($request->title) {
            $query->where('title', 'LIKE', ('%' . $request->title . '%'));
        }

        if($request->search && $request->keyword) {
            $query->where($request->search, 'like', ('%' . $request->keyword . '%'))->get();
        }

        $this->data['list'] = setSeq($query->get());

        return $this->data;
    }

    public function editService(Request $request)
    {
        $sid = $request->sid;
        $this->data['address'] = empty($sid) ? [] : $this->findMailAddress($sid);

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'address-create':
                return $this->addressCreateService($request);

            case 'address-update':
                return $this->addressUpdateService($request);

            case 'address-delete':
                return $this->addressDeleteService($request);

            default:
                return errorNotFoundRedirect();
        }
    }

    private function addressCreateService(Request $request)
    {
        $this->transaction();

        try {
            $address = (new MailAddress());
            $address->setByData($request);
            $address->save();

            $this->dbCommit('주소록관리 - 주소록 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "주소록이 생성되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function addressUpdateService(Request $request)
    {
        $this->transaction();

        try {
            $address = $this->findMailAddress($request->sid);
            $address->setByData($request);
            $address->update();

            $this->dbCommit('주소록관리 - 주소록 정보 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "주소록이 수정되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function addressDeleteService(Request $request)
    {
        $this->transaction();

        try {
            $sid = $request->sid;

            $address = $this->findMailAddress($sid);
            $address->delete();

            // 주소록에 속한 리스트 전부 삭제
            MailAddressList::where('ma_sid', $sid)->delete();

            $this->dbCommit('주소록관리 - 주소록 삭제', '주소록이 삭제되었습니다.');
            return $this->returnJsonData('location', $this->ajaxActionLocation('reload'));
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
