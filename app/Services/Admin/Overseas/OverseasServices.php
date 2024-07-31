<?php

namespace App\Services\Admin\Overseas;

use App\Models\Overseas;
use App\Models\OverseasConference;
use App\Models\User;

use App\Services\Admin\Mail\MailServices;
use App\Services\CommonServices;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\Overseas\OverseasExcel;

/**
 * Class AuthServices
 * @package App\Services
 */
class OverseasServices extends AppServices
{
    public function indexService(Request $request)
    {
        $query = OverseasConference::orderByDesc('sid');
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
        }

        $cnt = clone $query;
        $list = $query->paginate(10);
//        $list = $query->paginate(1)->append($request->except('page'));

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        /**
         * 통계
         */
        $categorylist = DB::select(DB::raw("SELECT GROUP_CONCAT(sid) `cate_sid` FROM overseas_conference WHERE del='N' "));


        $cate_arr = explode(',',$categorylist[0]->cate_sid);

        $cate_static = array();
        foreach ($cate_arr as $cate){
             $cate_static[$cate]= DB::select(
                DB::raw(
                    "SELECT SUM(CASE WHEN result='U' THEN 1 ELSE 0 END) AS u_cnt
                    , SUM(CASE WHEN result='S' THEN 1 ELSE 0 END) AS s_cnt
                    , SUM(CASE WHEN result='D' THEN 1 ELSE 0 END) AS d_cnt
                    , SUM(CASE WHEN result='I' THEN 1 ELSE 0 END) AS i_cnt
                    , SUM(CASE WHEN result='W' THEN 1 ELSE 0 END) AS w_cnt
                    , SUM(CASE WHEN result='C' THEN 1 ELSE 0 END) AS c_cnt
                    , SUM(1) AS tot_cnt

                    FROM overseas
                    WHERE csid = '{$cate}' AND del = 'N'
                    ")
             );
        }

        foreach ($this->data['list'] as $key => $item){
            $item->static = $cate_static[$item->sid];
        }
        
        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid ?? null;
        $this->data['conference'] = empty($sid) ? null : OverseasConference::findOrFail($sid);

        return $this->data;
    }

    public function directService(Request $request)
    {
        $csid = $request->csid ?? null;
        $this->data['conference'] = empty($csid) ? null : OverseasConference::findOrFail($csid);
        $this->data['user'] = empty($request->user_sid) ? null : User::findOrFail($request->user_sid);
        $this->data['overseas'] = empty($request->overseas_sid) ? null : Overseas::findOrFail($request->overseas_sid);
        return $this->data;
    }

    public function listService(Request $request)
    {
        $this->data['conference'] = empty($request->csid) ? null : OverseasConference::findOrFail($request->csid);

        $query = Overseas::where('csid', $request->csid)->orderByDesc('sid');
        $query->where('del', '=', 'N');

        if (!empty($search) && !empty($keyword)) {
            switch ($search) {
                default:
                    $query->where($search, 'like', "%{$keyword}%");
                    break;
            }
        }

        if ($request->name_kr || $request->email) { // 이름
            $query->whereHas('user', function (Builder $querySub) use ($request) {
                if($request->name_kr) $querySub->where('name_kr', 'like', '%' . $request->name_kr . '%');
                if($request->email) $querySub->where('uid', 'like', '%' . $request->email . '%');
            });
        }

        if (!empty($request->result)) {
            $query->where('result', '=', $request->result);
        }
        if (!empty($request->assistant)) {
            $query->where('assistant', '=', $request->assistant);
        }

        // 엑셀 다운로드 일경우
        if ($request->excel) {
            $this->data['collection']= setSeq($query->get());
            $fileName = '해외학회';
            return (new CommonServices())->excelDownload(new OverseasExcel($this->data), $fileName);
        }

        $cnt = clone $query;
        $list = $query->paginate(10);
//        $list = $query->paginate(1)->append($request->except('page'));

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

//        customDump($this->data);

        return $this->data;
    }

    public function assistService(Request $request)
    {
        $this->data['overseas'] = Overseas::findOrFail($request->sid);
        $this->data['user'] = User::findOrFail($request->user_sid);
        return $this->data;
    }

    public function memoService(Request $request)
    {
        $this->data['overseas'] = Overseas::findOrFail($request->sid);
        return $this->data;
    }
    public function assistGroupService(Request $request)
    {
        $this->data['conference'] = OverseasConference::findOrFail($request->csid);
        $this->data['list'] = Overseas::where(['csid'=>$request->csid, 'del'=>'N'])->orderByDesc('sid')->get();
        return $this->data;
    }

    public function mailService(Request $request)
    {
        $this->data['conference'] = OverseasConference::findOrFail($request->csid);

        //서류제출 마감기한 형식
        $edate_arr = explode("-",$this->data['conference']->result_edate);
        $result_edate = $edate_arr[1].'/'.$edate_arr[2];

        $query = Overseas::where('csid', $request->csid)->orderByDesc('sid');
        $query->where('del', '=', 'N');

        switch ($request->type) {
            case 'A'/*선정*/:
                $query->where('result', '=', 'S');
                $this->data['mail_type'] = '선정 메일 발송';
                $this->data['mail_title'] = '[대한부정맥학회] '.$this->data['conference']->subject.' 참가지원 대상자 선정 및 정산서류 안내('.$result_edate.'까지)';
                $this->data['template_name'] = 'overseas-resultS';
                break;
            case 'B'/*미선정*/:
                $query->where('result', '=', 'D');
                $this->data['mail_type'] = '미선정 메일 발송';
                $this->data['mail_title'] = '[대한부정맥학회] '.$this->data['conference']->subject.' 참가지원 신청 결과 안내';
                $this->data['template_name'] = 'overseas-resultD';
                break;
            case 'C'/*제출요청*/:
                $query->where('del', '=', 'N');
                $this->data['mail_type'] = '결과보고서 제출 요청 메일 발송';
                $this->data['mail_title'] = '[대한부정맥학회] '.$this->data['conference']->subject.' 정산서류 도착 알림';
                $this->data['template_name'] = 'overseas-request';
                break;
            case 'D'/*지급완료*/:
                $query->where('del', '=', 'N');
                $this->data['mail_type'] = '지급 완료 메일 발송';
                $this->data['mail_title'] = '[대한부정맥학회] '.$this->data['conference']->subject.' 정산금 입금 완료 안내';
                $this->data['template_name'] = 'overseas-payResult';
                break;
            default:
                break;
        }

        $this->data['list'] = $query->get();
        return $this->data;

    }

    public function detailRegisterService(Request $request)
    {
        $this->data['conference'] = OverseasConference::findOrFail($request->csid);
        return $this->data;
    }

    public function detailModifyService(Request $request)
    {
        $this->data['overseas'] = Overseas::findOrFail($request->sid);
        $this->data['conference'] = OverseasConference::findOrFail($this->data['overseas']->csid);
        $this->data['user'] = User::findOrFail($this->data['overseas']->user_sid);

        return $this->data;
    }

    public function detailResultPreviewService(Request $request)
    {
        $this->data['overseas'] = Overseas::findOrFail($request->sid);
        $this->data['conference'] = OverseasConference::findOrFail($this->data['overseas']->csid);
        $this->data['user'] = User::findOrFail($this->data['overseas']->user_sid);

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'conference-create':
                return $this->conferenceCreateServices($request);

            case 'conference-update':
                return $this->conferenceUpdateServices($request);

            case 'conference-delete':
                return $this->conferenceDeleteServices($request);

            case 'overseas-create':
                return $this->overseasCreateServices($request);

            case 'overseas-update':
                return $this->overseasUpdateServices($request);

            case 'overseas-delete':
                return $this->overseasDeleteServices($request);

            case 'change-assist':
                return $this->changeAssistServices($request);

            case 'change-group-assist':
                return $this->changeGroupAssistServices($request);

            case 'change-pay-result':
                return $this->changePayResultServices($request);

            case 'overseas-memo':
                return $this->overseasMemoServices($request);

            case 'mail-send':
                return $this->mailSendServices($request);

            case 'uid-check':
                return $this->uidService($request);

            default:
                return notFoundRedirect();
        }
    }

    private function conferenceCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $conference = new OverseasConference();

            $registration_status = array();
            $res_cnt = count($request->regist_gubun);

            for ($i=0; $i<$res_cnt; $i++){
                if(strpos($request->regist_gubun[$i], '해당없음') !== false){
                    $registration_status[99] = $request->regist_gubun[$i];
                    continue;
                }
                $registration_status[$i+1] = $request->regist_gubun[$i];
            }
            $request->merge([ 'registration_status' => $registration_status ]);

            $conference->setBydata($request);
            $conference->save();

            $this->dbCommit('국제학술대회 생성');

//            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('overseas.register', ['sid' => $conference->sid]) ));
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '국제학술대회가 등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function conferenceUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $conference = OverseasConference::findOrFail($request->sid);

            $registration_status = array();
            $res_cnt = count($request->regist_gubun);

            for ($i=0; $i<$res_cnt; $i++){
                if(strpos($request->regist_gubun[$i], '해당없음') !== false){
                    $registration_status[99] = $request->regist_gubun[$i];
                    continue;
                }
                $registration_status[$i+1] = $request->regist_gubun[$i];
            }
            $request->merge([ 'registration_status' => $registration_status ]);

            // 회원사진 바로 삭제할수 있지만 DB update 실패시 사진 사라지면 안되서 변수로 임시 저장
            if ($request->file_del === 'Y') {
                $delete_file_path = $conference->image_path;
            }

            $conference->setBydata($request);
            $conference->update();

            $this->dbCommit('국제학술대회 수정');

//            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('overseas.preview', ['sid' => $overseas->sid]) ));
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '국제학술대회가 수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function conferenceDeleteServices(Request $request)
    {
        $this->transaction();

        try {
            $conference = OverseasConference::findOrFail($request->sid);
            $conference->del = 'Y';
            $conference->update();

            $this->dbCommit('국제학술대회 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '학술대회가 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function overseasCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = new Overseas();
            $overseas->setBydata($request);
            $overseas->save();

            $this->dbCommit('국제학술대회 신청 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '국제학술대회 신청이 등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);

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

            $this->dbCommit('국제학술대회 신청 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '국제학술대회 신청이 수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function overseasDeleteServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = Overseas::findOrFail($request->sid);

            $overseas->del = 'Y';
            $overseas->update();

            $this->dbCommit('연구비신청 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                // 'msg' => '연구비신청이 삭제 되었습니다.',
                'msg' => '참가 지원 신청이 삭제되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }


    private function changeAssistServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = Overseas::findOrFail($request->sid);

            if($request->result == 'S'/*선정*/){
                //선정인원 등록여부
                $overseasConference = OverseasConference::where(['del'=>'N', 'sid'=>$request->csid])->first();
                $limit_person = $overseasConference->limit_person ?? 0;

                $already_person = Overseas::where(['del'=>'N', 'csid'=>$request->csid, 'result'=>'S'])->whereNotIn('user_sid', [$request->user_sid])->count();

                if($limit_person <= $already_person) {
                    return $this->returnJsonData('alert', [
                        'case' => true,
                        'msg' => '선정 인원이 마감되었습니다.',
                        'winClose' => $this->ajaxActionWinClose(true),
                    ]);
                }
            }

            $overseas->result = $request->result;
            $overseas->assistant = $request->assistant;
            $overseas->update();

            $this->dbCommit('심사상태 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '심사상태가 변경 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function changeGroupAssistServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas_arr = json_decode($request->overseas_sid, true);
            $arr_cnt = count($overseas_arr);

            //선정인원 등록여부
            $overseasConference = OverseasConference::where(['del'=>'N', 'sid'=>$request->sid])->first();
            $limit_person = $overseasConference->limit_person ?? 0;

            $already_person = Overseas::where(['del'=>'N', 'csid'=>$request->sid, 'result'=>'S'])->count();

            if($limit_person < $already_person+$arr_cnt) {
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '선정 제한 인원을 초과하였습니다.',
                    'location' => $this->ajaxActionLocation('reload'),
                ]);
            }

            foreach ($overseas_arr as $sid){
                $overseas = Overseas::findOrFail($sid);

                $overseas->result = 'S';
                $overseas->assistant = $request->assistant;
                $overseas->update();
            }

            $this->dbCommit('심사상태 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '심사상태가 변경 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }


    private function changePayResultServices(Request $request)
    {

        $this->transaction();
        try {
            $overseas = Overseas::findOrFail($request->sid);

            if($request->target == 'Y'){
                $overseas->pay_result = 'Y';
                $overseas->pre_result = $overseas->result/*이전상태값*/;
                $overseas->result = 'C'/*정산완료*/;
            }else{
                $overseas->pay_result = 'N';
                $overseas->result = $overseas->pre_result;
//                $overseas->result = 'W'/*철회*/;
            }

            $overseas->update();

            $this->dbCommit('해외학술대회 지급상태 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '해외학술대회 지급상태가 변경 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function overseasMemoServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = Overseas::findOrFail($request->sid);
            $overseas->memo = $request->memo;
            $overseas->update();

            $this->dbCommit('어드민 해외학술대회 메모 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '관리자 메모가 등록되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function mailSendServices(Request $request)
    {
        $this->overseasConfig = config('site.overseas');
        try {
            // 선정 메일 발송
            $template_name = $request->template_name;
            $mail_title = $request->mail_title;

            $overseas_arr = json_decode($request->overseas_sid, true);

            foreach ($overseas_arr as $sid){

                $overseas = Overseas::findOrFail($sid);
                $user = $overseas->user;

                $user->conference_name = $overseas->conference->subject;
                $user->place = $overseas->conference->place;
                $user->assistant = $this->overseasConfig['assistant'][$overseas->assistant ?? '1'];
                $user->result_date = $overseas->conference->result_date;

                /**
                 * 미선정 인원
                 */
                $user->limit_person = $overseas->conference->limit_person ?? 0;
                $user->regist_person = Overseas::where(['del'=>'N', 'csid'=>$overseas->csid ])->count();

                /**
                 * event_date
                 */
                $custom_event_date = '';
                $sarr = explode("-",$overseas->conference->event_sdate);
                $custom_sdate = sprintf("%s년 %s월 %s일",$sarr[0],$sarr[1],$sarr[2]);
                $custom_event_date .= $custom_sdate;

                if($overseas->conference->event_sdate != $overseas->conference->event_edate || !$overseas->conference->event_edate){
//                    $earr = explode("-",$overseas->conference->event_edate);
//                    if($sarr[0] !== $earr[0]/*연도*/){
//                        $custom_edate = sprintf("%s년 %s월 %s일",$earr[0],$earr[1],$earr[2]);
//                    }else{
//                        if($sarr[1] !== $earr[1]/*월*/){
//                            $custom_edate = sprintf("%s월 %s일",$earr[1],$earr[2]);
//                        }else{
//                            if($sarr[2] !== $earr[2]/*일*/) {
//                                $custom_edate = sprintf("%s일", $earr[2]);
//                            }
//                        }
//                    }
                    $earr = explode("-",$overseas->conference->event_edate);
                    $custom_edate = sprintf("%s년 %s월 %s일",$earr[0],$earr[1],$earr[2]);
                    if($custom_edate){
                        $custom_event_date .= ' ~ '.$custom_edate;
                    }
                }
                $user->event_date = $custom_event_date;


                $sendMail = (new MailServices())->mailSendService($user, $mail_title, $template_name, 0);

                if($sendMail !== true) {
                    return $sendMail;
                }
            }

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '메일이 발송되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
    private function uidService(Request $request)
    {

        $user = User::where(['uid' => $request->uid])->first();

        if(!$user){
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '존재하지 않는 아이디입니다. 다시 입력해주세요.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } else {
            $overseas = Overseas::where(['csid' => $request->csid, 'user_sid'=>$user->sid ])->first();
            if(!$overseas){
                return $this->returnJsonData('location' , $this->ajaxActionLocation('replace', route('direct.overseas.register',[ 'csid'=>$request->csid, 'user_sid'=>$user->sid ])) );
            }else{
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '신청 내역이 존재합니다.',
                    'location' => $this->ajaxActionLocation('replace', route('direct.overseas.register',[ 'csid'=>$request->csid,  'user_sid'=>$user->sid, 'overseas_sid'=>$overseas->sid ])) ,
                ]);
            }
        }

    }

    /**
     * 선정인원 등록여부
     */
//    public function limitCheckService(Request $request)
//    {
//        $result = array();
//
//        //선정인원 등록여부
//        $overseasConference = OverseasConference::where(['del'=>'N', 'sid'=>$request->csid])->first();
//        $limit_person = $overseasConference->limit_person ?? 0;
//
//        $already_person = Overseas::where(['del'=>'N', 'csid'=>$request->csid, 'result'=>'S'])->count();
//
//        if($limit_person <= $already_person){
//            return $this->returnJsonData('alert', [
//                'case' => true,
//                'msg' => '국제학술대회가 등록 되었습니다.',
//                'winClose' => $this->ajaxActionWinClose(true),
//            ]);
//            $result = [
//                'msg' => '선정 인원이 마감되었습니다.',
//                'redirect' => 'reload',
//            ];
//
//            $result = [
//                'msg' => '선정 인원이 마감되었습니다.',
//                'url' => route('overseas.detail.assist',['user_sid'=>request()->user_sid, 'sid'=>request()->sid, 'csid'=>request()->csid]),
//                'redirect' => 'replace',
//            ];
//        }
//
//        return $result;
//    }

}
