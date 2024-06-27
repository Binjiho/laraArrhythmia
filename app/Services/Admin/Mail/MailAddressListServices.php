<?php

namespace App\Services\Admin\Mail;

use App\Models\MailAddress;
use App\Models\MailAddressList;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class MailAddressListServices
 * @package App\Services
 */
class MailAddressListServices extends AppServices
{
    public function findMailAddressList(int $sid = 0, $ma_sid)
    {
        return MailAddressList::where(['sid' => $sid, 'ma_sid' => $ma_sid])->firstOrFail();
    }

    public function detailListService(Request $request)
    {
        $ma_sid = $request->ma_sid;

        $this->data['address'] = (new MailAddressServices())->findMailAddress($ma_sid);

        $query = $this->data['address']->list()->orderBy('seq');

        if($request->searchKey) {
            $query->where($request->searchKey, 'LIKE', ('%' . $request->keyword . '%'));
        }

        $this->data['list'] = $query->paginate(20)->appends(request()->except(['page']));

        return $this->data;
    }

    public function editDataService(Request $request)
    {
        $sid = $request->sid;
        $this->data['address'] = empty($sid) ? [] : $this->findMailAddressList($request->sid, $request->ma_sid);
        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'individual-create':
                return $this->individualCreateService($request);

            case 'collective-create':
                return $this->collectiveCreateService($request);

            case 'addressList-update':
                return $this->addressListUpdateService($request);

            case 'addressList-delete':
                return $this->addressListDeleteService($request);

            case 'addressList-seq':
                return $this->addressListSeqService($request);

            default:
                return errorNotFoundRedirect();
        }
    }

    private function individualCreateService(Request $request)
    {
        $this->transaction();

        try {
            $addressList = (new MailAddressList());
            $addressList->setByData($request);
            $addressList->save();

            $this->dbCommit('주소록 관리 - 주소록개별등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "주소록이 등록되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function collectiveCreateService(Request $request)
    {
        $this->transaction();

        try {
            $data = json_decode($request->data);

            foreach ($data ?? [] as $row) {
                if(!empty($row->name) && !empty($row->email)) {
                    $row->ma_sid = $request->ma_sid;

                    $addressList = (new MailAddressList());
                    $addressList->setByData($row);
                    $addressList->save();
                }
            }

            $this->dbCommit('주소록 관리 - 주소록일괄등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "주소록이 등록되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            dd($e);
            return $this->dbRollback($e);
        }
    }

    private function addressListUpdateService(Request $request)
    {
        $this->transaction();

        try {
            $addressList = $this->findMailAddressList($request->sid, $request->ma_sid);
            $addressList->setByData($request);
            $addressList->update();

            $this->dbCommit('주소록 관리 - 주소록 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "수정되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function addressListDeleteService(Request $request)
    {
        $this->transaction();

        try {
            $ma_sid = $request->ma_sid;

            if($request->sid) {
                $addressList = $this->findMailAddressList($request->sid, $ma_sid);
                $seq = $addressList->seq;

                $addressList->delete();

                // 데이터 삭제후 seq 재정렬
                $addressList_seq = MailAddressList::where(['ma_sid' => $ma_sid, ['seq', '>', $seq]])->get();
                foreach ($addressList_seq as $row) {
                    $row->seq = ($row->seq - 1);
                    $row->update();
                }

                $this->dbCommit('주소록 관리 - 주소록 삭제', '삭제 되었습니다.');
            } else {
                MailAddressList::where('ma_sid', $ma_sid)->delete();
                $this->dbCommit('주소록 관리 - 주소록 전체삭제', '전체삭제 되었습니다.');
            }

            return $this->returnJsonData('location',  $this->ajaxActionLocation('reload'));
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function addressListSeqService(Request $request)
    {
        $this->transaction();

        try {
            foreach ($request->sortData as $row) {
                $addressList = $this->findMailAddressList($row['sid'], $request->ma_sid);
                $addressList->seq = $row['seq'];
                $addressList->update();
            }

            $this->dbCommit('주소록 관리 - 주소록 순서변경');
            return $this->returnJsonData('alert',  ['msg' => '변경 되었습니다.']);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
