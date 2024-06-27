<?php

namespace App\Services\Admin\Conference;

use App\Services\AppServices;
use App\Models\Conference;
use App\Models\Abstracts;
use App\Services\Conference\ConferenceServices as WebConferenceServices;
use Illuminate\Http\Request;

/**
 * Class AbstractServices
 * @package App\Services
 */
class AbstractServices extends AppServices
{
    private $webConferenceServices;

    public function __construct()
    {
        $this->webConferenceServices = new WebConferenceServices();
    }

    public function indexService(Request $request, string $case)
    {
        $name_kr = $request->name_kr;
        $regnum = $request->regnum;
        $uid = $request->uid;

        switch ($case) {
            case 'withdrawal';
                $query = Abstracts::onlyTrashed()->where('csid', $request->csid);
                break;

            default:
                $query = Abstracts::where('csid', $request->csid);
                break;
        }

        $query->with(['user'])->orderByDesc('sid');

        if ($name_kr) {
            $query->where('name_kr', 'like', "%{$name_kr}%");
        }

        if ($regnum) {
            $query->where('regnum', 'like', "%{$regnum}%");
        }

        if ($uid) {
            $query->where('uid', 'like', "%{$uid}%");
        }

        if ($request->excel) {
            return;
        }

        $list = $query->paginate(10);
        $this->data['list'] = setListSeq($list);
        $this->data['conference'] = Conference::findOrFail($request->csid);

        return $this->data;
    }

    public function modifyService(Request $request)
    {
        $this->data['abstract'] = Abstracts::withTrashed()->findOrFail($request->sid);
        $this->data['conference'] = $this->data['abstract']->conference;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'abstract-update':
                return $this->abstractUpdate($request);

            case 'abstract-delete':
                return $this->abstractDelete($request);

            case 'abstract-forceDelete':
                return $this->abstractForceDelete($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function abstractUpdate(Request $request)
    {
        $this->transaction();

        try {
            $abstract = Abstracts::findOrFail($request->sid);
            $abstract->setByData($request);
            $abstract->update();

            $this->dbCommit('관리자 초록 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function abstractDelete(Request $request)
    {
        $this->transaction();

        try {
            $abstract = Abstracts::onlyTrashed()->findOrFail($request->sid);
            $abstract->delete();

            $this->dbCommit('관리자 초록 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function abstractForceDelete(Request $request)
    {
        $this->transaction();

        try {
            $abstract = Abstracts::onlyTrashed()->findOrFail($request->sid);
            $abstract->forceDelete();

            $this->dbCommit('관리자 초록접수 완전 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '완전히 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }
}
