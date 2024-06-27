<?php

namespace App\Services\Conference;

use App\Models\Conference;
use App\Models\Registration;
use App\Models\Abstracts;
use App\Models\Group;
use App\Models\User;
use App\Models\Affiliation;
use App\Services\AppServices;
use App\Services\Admin\Mail\MailServices;

use Illuminate\Http\Request;

/**
 * Class ConferenceServices
 * @package App\Services
 */
class ConferenceServices extends AppServices
{
    public function listService(Request $request)
    {
        $year = $request->year ?? null;
        $category = $request->category ?? null;

        $query = Conference::orderByDesc('sid');

        if (!empty($year) ) {
            $query->where('year', '=', $year);
        }
        if (!empty($category) ) {
            $query->where('category', '=', $category);
        }
        $query->where('event_edate', '>=', date('Y-m-d'));

        if(!isAdmin()){
            $query->where('del', '=', 'N');
        }

        $cnt = clone $query;
        $list = $query->paginate(5);

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        $query = Conference::orderByDesc('sid');
        if (!empty($year) ) {
            $query->where('year', '=', $year);
        }
        if (!empty($category) ) {
            $query->where('category', '=', $category);
        }
        $query->where('event_edate', '<', date('Y-m-d'));
        $list_fin = $query->paginate(5)->appends([
            'year' => $year,
            'category' => $category,
        ]);
        $this->data['list_fin'] = setListSeq($list_fin);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        if($request->sid){
            $this->data['conference'] = Conference::findOrFail($request->sid);
        }

        $authority_group = [];
        $categorylist = Group::where(['hide'=>'N'])->orderBy('sid')->get();
        foreach ($categorylist as $val){
            $authority_group[$val['sid']] = $val['subject'];
        }
        $this->data['res_authority_etc'] = $authority_group;
        return $this->data;
    }

    public function detailService(Request $request)
    {
        if($request->sid){
            $this->data['conference'] = Conference::findOrFail($request->sid);
        }

        $authority_group = [];
        $categorylist = Group::where(['hide'=>'N'])->orderBy('sid')->get();
        foreach ($categorylist as $val){
            $authority_group[$val['sid']] = $val['subject'];
        }
        $this->data['res_authority_etc'] = $authority_group;
        return $this->data;
    }

    public function confirmService(Request $request)
    {
        if($request->sid){
            $this->data['conference'] = Conference::findOrFail($request->sid);
        }
        return $this->data;
    }

    /**
     * 사전등록 신청 여부
     */
    public function registrationCheckService(Request $request)
    {
        $result = array();
        $check_regist = Registration::where(['del'=>'N', 'csid'=>$request->csid, 'user_sid'=>thisPk()])->first();
        if($check_regist){
            $result = [
                'msg' => '이미 사전등록을 하셨습니다.',
                'url' => route('conference.detail',['sid'=>$request->csid]),
                'redirect' => 'replace',
            ];
        }
        return $result;
    }
    public function registrationUpsertService(Request $request)
    {
        $isLogin = false;

        if($request->csid){
            $this->data['conference'] = Conference::findOrFail($request->csid);
        }
        if($request->sid){
            $this->data['registration'] = Registration::findOrFail($request->sid);
        }

        $this->data['affi'] = getAffi();
        $this->data['country'] = getCountry();

        $user = User::find(['sid',thisPk()])->first();
        $this->data['user'] = $user;
        if($user){
            $isLogin = true;
        }
        $this->data['isLogin'] = $isLogin;
        return $this->data;
    }

    public function abstractUpsertService(Request $request)
    {
        $isLogin = false;

        if($request->csid){
            $this->data['conference'] = Conference::findOrFail($request->csid);
        }
        if($request->sid){
            $this->data['abstract'] = Abstracts::findOrFail($request->sid);
        }

        $this->data['affi'] = getAffi();
        $this->data['country'] = getCountry();

        $user = User::find(['sid',thisPk()])->first();
        $this->data['user'] = $user;
        if($user){
            $isLogin = true;
        }
        $this->data['isLogin'] = $isLogin;
        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'conference-create':
                return $this->conferenceCreate($request);

            case 'conference-update':
                return $this->conferenceUpdate($request);

            case 'conference-delete':
                return $this->conferenceDelete($request);

            case 'conference-hide':
                return $this->conferenceHide($request);

            case 'registration-create':
                return $this->registrationCreate($request);

            case 'registration-update':
                return $this->registrationUpdate($request);

            case 'registration-delete':
                return $this->registrationDelete($request);

            case 'abstract-regist':
                return $this->abstractRegist($request);

            case 'abstract-create':
                return $this->abstractCreate($request);

            case 'abstract-update':
                return $this->abstractUpdate($request);

            case 'abstract-delete':
                return $this->abstractDelete($request);

            case 'sosok-check':
                return $this->sosokCheckServices($request);

            case 'confirm-check':
                return $this->confirmCheckServices($request);

            case 'uid-check':
                return $this->uidCheckServices($request);

            default:
                return notFoundRedirect();
        }
    }

    private function conferenceCreate(Request $request)
    {
        $this->transaction();

        try {
            $conference = new Conference();

            $res_fee = array();
            $res_cnt = count($request->regist_gubun);

            for ($i=0; $i<$res_cnt; $i++){
                $res_fee[] = [
                    'gubun' => $request->regist_gubun[$i],
                    'early' => $request->regist_early[$i],
                    'onsite' => $request->regist_onsite[$i],
                ];
            }
            $request->merge([ 'res_fee' => $res_fee ]);

            $conference->setBydata($request);
            $conference->save();

            $this->dbCommit('학술행사 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '학술행사가 생성 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('conference')),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function conferenceUpdate(Request $request)
    {
        $this->transaction();

        try {
            $conference = Conference::findOrFail($request->sid);

            $res_fee = array();
            $res_cnt = count($request->regist_gubun);

            for ($i=0; $i<$res_cnt; $i++){
                $res_fee[] = [
                    'gubun' => $request->regist_gubun[$i],
                    'early' => $request->regist_early[$i],
                    'onsite' => $request->regist_onsite[$i],
                ];
            }
            $request->merge([ 'res_fee' => $res_fee ]);

            $conference->setBydata($request);
            $conference->update();

            $this->dbCommit('학술행사 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '학술행사가 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('conference')),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function conferenceHide(Request $request)
    {
        $this->transaction();

        try {
            $conference = Conference::findOrFail($request->sid);
            $conference->hide = $request->hide;
            $conference->update();

            $this->dbCommit('학술행사 공개여부변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '학술행사 공개여부가 변경 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('conference')),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function conferenceDelete(Request $request)
    {
        $this->transaction();

        try {
            $conference = Conference::findOrFail($request->sid);
            $conference->delete();

            $this->dbCommit('학술행사 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '학술행사가 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('conference')),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function registrationCreate(Request $request)
    {
        $this->transaction();

        try {
            $registration = new Registration();

            $pay_status = 'N';
            if($request->tot_pay=='0'){
                $pay_status = 'F';
            }
            if($request->method=='C'/*카드*/){
//                $pay_status = 'N';
            }
            $request->merge([ 'pay_status' => $pay_status ]);

            //사전 등록코드
            $reg_arr = Registration::where([ 'del'=>'N', 'year'=>date('Y') ])->get();
            $reg_cnt = count($reg_arr);
            $regnum = substr(date('Y'),2,2).'R-'.sprintf("%03d",(int)$reg_cnt+1);
            $request->merge([ 'regnum' => $regnum ]);

            $registration->setBydata($request);
            $registration->save();

            //사전등록 메일 발송
            $postion_arr = array();
            $this->userConfig = config('site.user');
            $this->conferenceConfig = config('site.conference');
            foreach($this->userConfig['position'] as $position_key => $position_val) {
                if (in_array($position_key, ($registration->position ?? []))){
                    $postion_arr[] = $position_val;
                }
            }
            if(!empty($registration->position_etc)){
                $postion_arr[] = $registration->position_etc;
            }
            $registration->custom_position =implode(',', $postion_arr);
            $registration->custom_country =getCountryCn($registration->country ?? '1');
            $registration->custom_gubun =$this->conferenceConfig['method'][$registration->method ?? 'B' ];



            $conference = Conference::findOrFail($request->csid);

            $registration->custom_subject = $conference->subject;

            $registration->custom_account = $conference->account ?? '우리은행 1005-403-444745 (예금주 : 대한부정맥학회)';

            $registration->custom_pay_status =$this->conferenceConfig['pay_status'][$registration->pay_status ?? 'N' ];

            $mail_subject = "[대한부정맥학회] ".$conference->subject." 사전등록 접수가 완료되었습니다.";

            $sendMail = (new MailServices())->mailSendService($registration, $mail_subject, 'registration-create', 0, $regnum);
            if($sendMail !== true) {
                return $sendMail;
            }

            $this->dbCommit('사전등록 참여 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '사전등록 참여가 완료 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('conference.registration.complete',['sid'=>$registration->sid,'csid'=>$registration->csid, ]) ),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function registrationUpdate(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::findOrFail($request->sid);
            $pay_status = 'N';
            if($request->tot_pay=='0'){
                $pay_status = 'F';
            }
            if($request->method=='C'/*카드*/){
//                $pay_status = 'N';
            }
            $request->merge([ 'pay_status' => $pay_status ]);

            $registration->setBydata($request);
            $registration->update();

            $this->dbCommit('사전등록 참여 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '사전등록 참여가 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('conference.detail',['sid'=>$request->csid]) ),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function abstractRegist(Request $request)
    {
        $this->transaction();

        try {
            $abstract = new Abstracts();
            $abstract->setBydata($request);
            $abstract->save();

            $this->dbCommit('초록접수 생성');

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('conference.abstract.preview',['sid'=>$abstract->sid,'csid'=>$request->csid, 'step'=>'2']) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }
    private function abstractCreate(Request $request)
    {
        $this->transaction();

        try {
            $abstract = Abstracts::findOrFail($request->sid);

            //초록등록코드
            $reg_arr = Abstracts::where([ 'del'=>'N', 'year'=>date('Y'), 'status'=>'Y' ])->get();
            $reg_cnt = count($reg_arr);
            $regnum = substr(date('Y'),2,2).'A-'.sprintf("%03d",(int)$reg_cnt+1);

            $abstract->regnum = $regnum;
            $abstract->status = 'Y';
            $abstract->save();

            //초록등록 메일 발송
            $this->userConfig = config('site.user');
            $this->conferenceConfig = config('site.conference');

            $gubun_arr = array();
            foreach($this->conferenceConfig['abs_gubun'] as $key => $val) {
                if (in_array($key, ($abstract->position ?? []))){
                    $gubun_arr[] = $val;
                }
            }
            if(!empty($abstract->gubun_etc)){
                $gubun_arr[] = $abstract->gubun_etc;
            }
            $abstract->custom_gubun =implode(',', $gubun_arr);

            $p_position_arr = array();
            foreach($this->conferenceConfig['p_position'] as $key => $val) {
                if (in_array($key, ($abstract->p_position ?? []))){
                    $p_position_arr[] = $val;
                }
            }
            if(!empty($abstract->p_position_etc)){
                $p_position_arr[] = $abstract->p_position_etc;
            }
            $abstract->custom_p_position =implode(',', $p_position_arr);

            $abstract->custom_type =$this->conferenceConfig['abs_type'][$abstract->type ?? '' ];
            
            $conference = Conference::findOrFail($abstract->csid);
            $abstract->custom_subject = $conference->subject;
            $abstract->custom_account = $conference->account;

//            $abstract->name_kr = $abstract->p_name;
//            $abstract->uid = $abstract->p_email;

            $mail_subject = "[대한부정맥학회] ".$conference->subject." 초록접수가 완료 완료되었습니다.";
            $sendMail = (new MailServices())->mailSendService($abstract, $mail_subject, 'abstract-create', 0, $regnum);
            if($sendMail !== true) {
                return $sendMail;
            }

            $this->dbCommit('초록접수 최종제출');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '초록접수가 완료 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('conference.abstract.complete',['sid'=>$abstract->sid,'csid'=>$abstract->csid, ]) ),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function abstractUpdate(Request $request)
    {
        $this->transaction();

        try {
            $abstract = Abstracts::findOrFail($request->sid);

            $abstract->setBydata($request);
            $abstract->update();

            $this->dbCommit('초록접수 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '초록접수가 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('conference.detail',['sid'=>$request->csid, 'tab'=>4]) ),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function sosokCheckServices(Request $request)
    {
        $affi = Affiliation::where(['sid' => $request->affi_sid])->first();

        if($affi->sid == '999'){
            $this->setJsonData('prop', [
                $this->ajaxActionProp('#sosok_kr', "readonly", FALSE ),
                $this->ajaxActionProp('#sosok_en', "readonly", FALSE ),
            ]);
            return $this->returnJsonData('input', [
                $this->ajaxActionInput('#sosok_kr', '' ),
                $this->ajaxActionInput('#sosok_en', '' ),
            ]);
        }else{
            $this->setJsonData('prop', [
                $this->ajaxActionProp('#sosok_kr', "readonly", TRUE ),
                $this->ajaxActionProp('#sosok_en', "readonly", TRUE ),
            ]);
            return $this->returnJsonData('input', [
                $this->ajaxActionInput('#sosok_kr', $affi->office_k ),
                $this->ajaxActionInput('#sosok_en', $affi->office_e ),
            ]);
        }

    }

    private function confirmCheckServices(Request $request)
    {
        if($request->tab == '3'/*사전등록*/)
        {
            $check = Registration::where(['del'=>'N', 'csid'=>$request->csid, 'name_kr'=>$request->name_kr, 'uid'=>$request->uid ])->first();
            if(!$check){
                return $this->returnJsonData('alert', [
                    'msg' => '입력하신 내용과 일치하는 등록 내역이 없습니다.다시 입력 해주세요.',
                ]);
            }else{
                return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('conference.registration.preview',['csid'=>$request->csid, 'sid'=>$check->sid]) ));
            }
        } else if($request->tab == '4'/*초록접수*/) {
            $check = Abstracts::where(['del'=>'N', 'status'=>'Y', 'csid'=>$request->csid, 'name_kr'=>$request->name_kr, 'uid'=>$request->uid ])->first();
            if(!$check){
                return $this->returnJsonData('alert', [
                    'msg' => '입력하신 내용과 일치하는 등록 내역이 없습니다.다시 입력 해주세요.',
                ]);
            }else{
                return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('conference.abstract.preview',['csid'=>$request->csid, 'sid'=>$check->sid]) ));
            }
        }
    }

    private function uidCheckServices(Request $request)
    {
        if($request->tab == '3'/*사전등록*/)
        {
            $check = Registration::where(['del'=>'N', 'csid'=>$request->csid, 'uid'=>$request->uid ])->first();
        } else if($request->tab == '4'/*초록접수*/) {
            $check = Abstracts::where(['del'=>'N', 'status'=>'Y', 'csid'=>$request->csid, 'uid'=>$request->uid ])->first();
        }

        if (empty($check)) {
            $this->setJsonData('data', [
                $this->ajaxActionData('#uid', 'chk', 'Y'),
            ]);

            return $this->returnJsonData('alert', [
                'msg' => '사용가능한 아이디 입니다.',
            ]);
        } else {
            $this->setJsonData('focus', '#uid');

            return $this->returnJsonData('alert', [
                'msg' => '이미 등록완료한 아이디입니다. 다른 아이디를 입력해주세요.',
            ]);
        }
    }
}
