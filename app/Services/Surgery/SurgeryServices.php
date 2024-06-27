<?php

namespace App\Services\Surgery;

use App\Models\Surgery;
use App\Models\SurgeryResult;
use App\Models\User;
use App\Models\Career;
use App\Models\SurgeryCase;

use App\Services\Admin\Mail\MailServices;
use App\Services\CommonServices;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthServices
 * @package App\Services
 */
class SurgeryServices extends AppServices
{
    public function registerService(Request $request)
    {
        $this->data['user'] = User::findOrFail(thisPk());

        if($request->sid){
            $this->data['surgery'] = Surgery::findOrFail($request->sid);
        }
        return $this->data;
    }

    public function checkRegisterService(Request $request)
    {
        $this->data['user'] = User::findOrFail(thisPk());

        $this->data['surgery'] = Surgery::where(['user_sid' => $this->data['user']->sid, 'year'=>date('Y') ])->first();

       return $this->data;
    }

    public function judgeService(Request $request)
    {
        $this->data['user'] = thisUser();
        $this->data['surgery'] = Surgery::findOrFail($request->sid);
        $this->data['result'] = SurgeryResult::where([ 'surgery_sid'=>$request->sid, 'reviewer_sid'=>thisPk() ])->first();

        return $this->data;
    }

//    public function careerRegisterService(Request $request)
//    {
//        $this->data['user'] = User::findOrFail(thisPk());
//
//        if($request->sid){
//            $this->data['career'] = Career::findOrFail($request->sid);
//        }
//        return $this->data;
//    }
//
//    public function caseRegisterService(Request $request)
//    {
//        $this->data['user'] = User::findOrFail(thisPk());
//
//        if($request->sid){
//            $this->data['case'] = SurgeryCase::findOrFail($request->sid);
//        }
//        return $this->data;
//    }
    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'surgery-create':
                return $this->surgeryCreateServices($request);

            case 'surgery-update':
                return $this->surgeryUpdateServices($request);

            case 'career-create':
                return $this->careerCreateServices($request);

            case 'career-update':
                return $this->careerUpdateServices($request);

            case 'career-delete':
                return $this->careerDeleteServices($request);

            case 'case-create':
                return $this->caseCreateServices($request);

            case 'case-update':
                return $this->caseUpdateServices($request);

            case 'case-delete':
                return $this->caseDeleteServices($request);

            case 'open-layer':
                return $this->openLayer($request);

            case 'surgery-judge':
                return $this->surgeryJudgeServices($request);
                
            default:
                return notFoundRedirect();
        }
    }

    private function surgeryCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $surgery = new Surgery();

            //심사등록코드
            $reg_cnt = Surgery::where([ 'del'=>'N', 'year'=>date('Y') ])->count();
            $regnum = 'I-'.date('Y').'-'.sprintf("%03d",(int)$reg_cnt+1);
            $request->merge([ 'regnum' => $regnum ]);

            $surgery->setBydata($request);
            $surgery->save();

            //경력 career
            if($request->career_arr){
                $career_sid_arr = explode(',',$request->career_arr);
                foreach ($career_sid_arr as $career_sid){
                    $career = Career::findOrFail($career_sid);
                    $career->surgery_sid = $surgery->sid;
                    $career->update();
                }
            }
            //증례 case
            if($request->case_arr){
                $case_sid_arr = explode(',',$request->case_arr);
                foreach ($case_sid_arr as $case_sid){
                    $case = SurgeryCase::findOrFail($case_sid);
                    $case->surgery_sid = $surgery->sid;
                    $case->update();
                }
            }

            $this->dbCommit('중재시술인증 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '중재시술인증이 등록 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('surgery') ),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function surgeryUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $surgery = Surgery::findOrFail($request->sid);

//            // 회원사진 바로 삭제할수 있지만 DB update 실패시 사진 사라지면 안되서 변수로 임시 저장
//            if ($request->file_del === 'Y') {
//                $delete_file_path = $surgery->image_path;
//            }

            $surgery->setBydata($request);
            $surgery->update();

            //경력 career
            if($request->career_arr){
                $career_sid_arr = explode(',',$request->career_arr);
                foreach ($career_sid_arr as $career_sid){
                    $career = Career::findOrFail($career_sid);
                    $career->surgery_sid = $surgery->sid;
                    $career->update();
                }
            }
            //증례 case
            if($request->case_arr){
                $case_sid_arr = explode(',',$request->case_arr);
                foreach ($case_sid_arr as $case_sid){
                    $case = SurgeryCase::findOrFail($case_sid);
                    $case->surgery_sid = $surgery->sid;
                    $case->update();
                }
            }

            $this->dbCommit('중재시술인증 수정');

            if($request->mypage=='Y'){
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '중재시술인증 수정이 완료 되었습니다.',
                    'location' => $this->ajaxActionLocation('replace', route('mypage.surgery') ),
                ]);
            }else{
                return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('surgery.preview', ['sid' => $surgery->sid]) ));
            }

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function careerCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $career = new Career();

            $career->setBydata($request);
            $career->save();

            $this->dbCommit('중재시술경력 생성');

            $this->data['career'] = $career;
            $this->setJsonData('append', [
                $this->ajaxActionHtml('#career_tbl', view('surgery.form.careerTable', $this->data)->render() ),
            ]);

            $this->setJsonData('remove', [
                $this->ajaxActionRemove('#layerArea'),
            ]);

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '경력이 추가 되었습니다.',
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function careerUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $career = Career::findOrFail($request->sid);

            $career->setBydata($request);
            $career->update();

            $this->dbCommit('중재시술경력 수정');

            $this->data['career'] = $career;
//            dd($this->data['career']);

            $this->setJsonData('replace', [
                $this->ajaxActionHtml('#career_'.$request->sid, view('surgery.form.careerTable', $this->data)->render() ),
            ]);

            $this->setJsonData('remove', [
                $this->ajaxActionRemove('#layerArea'),
            ]);

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '경력이 수정 되었습니다.',
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function careerDeleteServices(Request $request)
    {
        $this->transaction();

        try {
            $career = Career::findOrFail($request->sid);
            $career->del = 'Y';
            $career->deleted_at = date('Y-m-d H:i:s');
            $career->update();

            $this->dbCommit('중재시술경력 삭제');

            $this->setJsonData('remove', [
                $this->ajaxActionRemove('#career_'.$request->sid),
            ]);

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '중재시술경력 삭제가 완료 되었습니다.',
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function caseCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $case = new SurgeryCase();

            $case->setBydata($request);
            $case->save();

            $this->dbCommit('중재시술증례 생성');

            $this->data['case'] = $case;

            $this->setJsonData('append', [
                $this->ajaxActionHtml('#case_tbl', view('surgery.form.caseTable', $this->data)->render() ),
            ]);

            $this->setJsonData('remove', [
                $this->ajaxActionRemove('#layerArea'),
            ]);

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '증례가 추가 되었습니다.',
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }

    }

    private function caseUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $case = SurgeryCase::findOrFail($request->sid);

            $case->setBydata($request);
            $case->update();

            $this->dbCommit('중재시술증례 수정');

            $this->data['case'] = $case;

            $this->setJsonData('replace', [
                $this->ajaxActionHtml('#case_'.$request->sid, view('surgery.form.caseTable', $this->data)->render() ),
            ]);

            $this->setJsonData('remove', [
                $this->ajaxActionRemove('#layerArea'),
            ]);

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '증례가 수정 되었습니다.',
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function caseDeleteServices(Request $request)
    {
        $this->transaction();

        try {
            $case = SurgeryCase::findOrFail($request->sid);
            $case->del = 'Y';
            $case->deleted_at = date('Y-m-d H:i:s');
            $case->update();

            $this->dbCommit('중재시술증례 삭제');

            $this->setJsonData('remove', [
                $this->ajaxActionRemove('#case_'.$request->sid),
            ]);

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '중재시술증례 삭제가 완료 되었습니다.',
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function openLayer(Request $request)
    {
        if($request->type == 'career'){
            $this->data['career'] = Career::where(['sid'=>$request->sid,])->first();
        }else if($request->type == 'case'){
            $this->data['case'] = SurgeryCase::where(['sid'=>$request->sid,])->first();
        }
        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('body', view('surgery.layer.'.$request->type, $this->data)->render()),
        ]);
    }

    private function surgeryJudgeServices(Request $request)
    {
        $this->transaction();

        try {
            $result = SurgeryResult::findOrFail($request->sid);

            $result->setBydata($request);

            if($request->state == 'Y'){
                $msg = "중재시술인증 심사가 완료 되었습니다.";
            }else{
                $msg = "중재시술인증 심사가 등록 되었습니다.";
            }
            $result->update();

            //해당 surgery에 심사 총 갯수
            $tot_cnt = SurgeryResult::where(['del'=>'N', 'surgery_sid'=> $result->surgery_sid])->count();
            //해당 surgery에 심사 완료 갯수
            $y_cnt = SurgeryResult::where(['del'=>'N', 'surgery_sid'=> $result->surgery_sid, 'state'=>'Y'])->count();

            if($tot_cnt<= $y_cnt+1 ){
                //배정된 심사 전부 완료시
                $surgery = Surgery::findOrFail($result->surgery_sid);
                $surgery->result = 'S';
                $surgery->update();
            }
            /* 해당 상태 값 삭제
            else{
                //배정된 심사 진행중
                $surgery = Surgery::findOrFail($result->surgery_sid);
                $surgery->result = 'I';
                $surgery->update();
            }
            */

            $this->dbCommit('중재시술인증 심사 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => $msg,
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

}
