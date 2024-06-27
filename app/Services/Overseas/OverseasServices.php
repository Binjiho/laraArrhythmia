<?php

namespace App\Services\Overseas;

use App\Models\Overseas;
use App\Models\OverseasConference;
use App\Models\User;

use App\Services\Admin\Mail\MailServices;
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
    public function listService(Request $request)
    {
        $query = OverseasConference::orderByDesc('sid');
//        $query->where('user_sid', thisPk());
        
        $query->where('regist_sdate', '<=', date('Y-m-d'));
        $query->where('regist_edate', '>=', date('Y-m-d'));

        $query->where('del', '=', 'N');

        if (!empty($search) && !empty($keyword)) {
            switch ($search) {
                default:
                    $query->where($search, 'like', "%{$keyword}%");
                    break;
            }
        }
        if (!empty($year) ) {
            $query->where('year', '=', $year);
        }
        if(!isAdmin()){
            $query->where('hide', '=', 'N');
            $query->where('del', '=', 'N');
        }

        $cnt = clone $query;
        $list = $query->paginate(10);
//        $list = $query->paginate(1)->append($request->except('page'));

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

//        customDump($this->data);

        return $this->data;
    }

    public function registerService(Request $request)
    {
        $this->data['user'] = User::findOrFail(thisPk());

        if($request->sid){
            $this->data['overseas'] = Overseas::findOrFail($request->sid);
            $this->data['conference'] = OverseasConference::findOrFail($this->data['overseas']->csid);
        }else{
            $this->data['conference'] = OverseasConference::findOrFail($request->csid);
        }

        return $this->data;
    }
    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'overseas-create':
                return $this->overseasCreateServices($request);

            case 'overseas-update':
                return $this->overseasUpdateServices($request);

            case 'overseas-complete':
                return $this->overseasCompleteServices($request);

            case 'overseas-delete':
                return $this->overseasDeleteServices($request);
                
            default:
                return notFoundRedirect();
        }
    }

    private function overseasCreateServices(Request $request)
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

            $this->dbCommit('해외학회신청 생성');

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('overseas.preview', ['sid' => $overseas->sid]) ));
//            return $this->returnJsonData('alert', [
//                'case' => true,
//                'msg' => '해외학회신청이 등록 되었습니다.',
//                'location' => $this->ajaxActionLocation('replace', $this->previewUrl()),
//            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function overseasUpdateServices(Request $request)
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

            $this->dbCommit('해외학회신청 수정');

            if($request->mypage=='Y'){
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '해외학회신청 수정이 완료 되었습니다.',
                    'location' => $this->ajaxActionLocation('replace', route('mypage.overseas') ),
                ]);
            }else{
                return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('overseas.preview', ['sid' => $overseas->sid]) ));
            }

        } catch (\Exception $e) {
            return $this->dbRollback($e);
//            return $this->dbRollback($e,true);
        }
    }
    private function overseasCompleteServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = Overseas::FindOrFail($request->sid);
            /**
             * 등록번호
             */
//            if(!$request->sid){
//                $regnum = sprintf("04d");
//            }
//            $overseas->state = 'Y';
//            $overseas->save();

            $this->dbCommit('해외학회신청 complete');

            // 해외학회 신청 메일 발송
            $user = User::FindOrFail($overseas->user_sid);

            $conference = OverseasConference::FindOrFail($overseas->csid);

            $user->conference_name = $conference->subject;

            $mail_title = "[대한부정맥학회] {$conference->subject} 참가지원 신청이 완료되었습니다.";
            $sendMail = (new MailServices())->mailSendService($user, $mail_title, 'overseas-regist', 0);

            if($sendMail !== true) {
                return $sendMail;
            }
            
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '해외학회신청이 완료 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('overseas.complete', ['sid' => $overseas->sid]) ),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
//            return $this->dbRollback($e,true);
        }
    }

    private function overseasDeleteServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = Overseas::findOrFail($request->sid);
            $overseas->del = 'Y';
            $overseas->update();

            $this->dbCommit('해외학회신청 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '해외학회신청 삭제가 완료 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('mypage.overseas') ),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function listUrl()
    {
        return route('overseas.info');
    }

}
