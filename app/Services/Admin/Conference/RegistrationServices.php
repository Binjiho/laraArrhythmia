<?php

namespace App\Services\Admin\Conference;

use App\Services\AppServices;
use App\Models\Conference;
use App\Models\Registration;
use App\Services\Conference\ConferenceServices as WebConferenceServices;
use Illuminate\Http\Request;

/**
 * Class RegistrationServices
 * @package App\Services
 */
class RegistrationServices extends AppServices
{
    private $webConferenceServices;

    public function __construct()
    {
        $this->webConferenceServices = new WebConferenceServices();
    }

    public function indexService(Request $request, string $case)
    {
        $name = $request->name;
        $email = $request->email;
        $license_number = $request->license_number;

        $uid = $request->uid;
        $category = $request->category;
        $sosok = $request->sosok;

        $phone = $request->phone;
        $fee_pay_status = $request->fee_pay_status;
        $pay_status = $request->pay_status;

        switch ($case) {
            case 'withdrawal';
                $query = Registration::onlyTrashed()->where('csid', $request->csid);
                break;

            default:
                $query = Registration::where('csid', $request->csid);
                break;
        }

        $query->with(['user'])->orderByDesc('sid');

        if ($name) {
            $query->where(function ($q) use ($name) {
                $q->where('name_kr', 'like', "%{$name}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE '%{$name}%'");
            });
        }

        if ($email) {
            $query->where('uid', 'like', "%{$email}%");
        }

        if ($license_number) {
            $query->where('license_number', 'like', "%{$license_number}%");
        }

        if ($uid) {
            $query->where('uid', 'like', "%{$uid}%");
        }

        if ($category) {
            $query->whereHas('user', function ($q) use ($category) {
                $q->where('category', $category);
            });
        }

        if ($sosok) {
            $query->where(function ($q) use ($sosok) {
                $q->where('sosok_kr', 'like', "%{$sosok}%")
                    ->orWhere('sosok_en', 'like', "%{$sosok}%");
            });
        }

        if ($phone) {
            $query->where('phone', 'like', "%{$phone}%");
        }

        if ($fee_pay_status) {
            $query->whereHas('user', function ($q) use ($fee_pay_status) {
                $q->where('pay_status', $fee_pay_status);
            });
        }

        if ($pay_status) {
            $query->where('pay_status', $pay_status);
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
        $this->data['registration'] = Registration::findOrFail($request->sid);
        $this->data['conference'] = $this->data['registration']->conference;

        $this->data['user'] = $this->data['registration']->user;
        $this->data['affi'] = getAffi();
        $this->data['country'] = getCountry();
        $this->data['isLogin'] = true;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'registration-update':
                return $this->registrationUpdate($request);

            case 'registration-delete':
                return $this->registrationDelete($request);

            case 'registration-forceDelete':
                return $this->registrationForceDelete($request);

            case 'change-result':
                return $this->changeResultServices($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function registrationUpdate(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::withTrashed()->findOrFail($request->sid);

            $request->merge(['pay_status' => $registration->pay_status]);

            $registration->setBydata($request);
            $registration->update();

            $this->dbCommit('관리자 사전등록 참여 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function registrationDelete(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::findOrFail($request->sid);
            $registration->delete();

            $this->dbCommit('관리자 사전등록 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function registrationForceDelete(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::onlyTrashed()->findOrFail($request->sid);
            $registration->forceDelete();

            $this->dbCommit('관리자 사전등록 완전 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '완전히 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function changeResultServices(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::findOrFail($request->sid);
            $registration->attend = $request->target;
            $registration->update();

            $this->dbCommit('사전등록 - 참석상태 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '참석상태가 변경 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }
}
