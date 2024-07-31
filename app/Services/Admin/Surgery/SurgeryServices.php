<?php

namespace App\Services\Admin\Surgery;

use App\Models\Surgery;
use App\Models\SurgeryResult;
use App\Models\Reviewer;
use App\Models\Career;
use App\Models\SurgeryCase;
use App\Models\User;

use App\Exports\Surgery\SurgeryExcel;

use App\Services\CommonServices;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthServices
 * @package App\Services
 */
class SurgeryServices extends AppServices
{
    public function indexService(Request $request)
    {
        $query = Surgery::orderByDesc('created_at')->with(['user']);
        $query->where('del', '=', 'N');

        $name_kr = $request->name_kr;
        $email = $request->email;

        if ($name_kr) {
            $query->whereHas('user', function ($q) use($name_kr) {
                $q->where('name_kr', 'like', "%{$name_kr}%");
            });
        }
        if ($email) {
            $query->whereHas('user', function ($q) use($email) {
                $q->where('uid', 'like', "%{$email}%");
            });
        }

        if ($request->result) { // 심사현황
            $query->where('result', '=', $request->result);
        }

        // 엑셀 다운로드 일경우
        if ($request->excel) {
            $this->data['collection']= setSeq($query->get());
            $fileName = '중재시술인증 관리'.date('Y-m-d');
            return (new CommonServices())->excelDownload(new SurgeryExcel($this->data), $fileName);
        }

        $cnt = clone $query;
        $list = $query->paginate(10);

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function modifyService(Request $request)
    {
        $this->data['surgery'] = Surgery::findOrFail($request->sid);
        $this->data['user'] = $this->data['surgery']->user;
        return $this->data;
    }

    public function listService(Request $request)
    {
        $query = Reviewer::where(['code'=>'surgery', 'del'=>'N'])->orderByDesc('created_at')->with(['user']);
        $query->where('del', '=', 'N');

        $cnt = clone $query;
        $list = $query->paginate(10);

        //배정된 심사위원
        $this->data['reviewer_users'] = SurgeryResult::where(['surgery_sid'=>$request->surgery_sid])->pluck('reviewer_sid')->toArray();

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function previewService(Request $request)
    {
        $this->data['surgery'] = Surgery::findOrFail($request->sid);
        $this->data['user'] = User::findOrFail($this->data['surgery']->user_sid);
        $this->data['result'] = SurgeryResult::where([ 'surgery_sid'=>$request->sid, 'del'=>'N', 'state'=>'Y' ])->get();

        return $this->data;
    }
    

//    public function careerRegisterService(Request $request)
//    {
//        $this->data['career'] = Career::findOrFail($request->sid);
//        $this->data['surgery'] = Surgery::findOrFail($request->sid);
//        $this->data['user'] = $this->data['surgery']->user;
//
//        return $this->data;
//    }
//
//    public function caseRegisterService(Request $request)
//    {
//        $this->data['case'] = SurgeryCase::findOrFail($request->sid);
//        $this->data['surgery'] = Surgery::findOrFail($request->sid);
//        $this->data['user'] = $this->data['surgery']->user;
//
//        return $this->data;
//    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'collective-create':
                return $this->collectiveCreate($request);

            case 'change-result':
                return $this->changeResultServices($request);

            case 'reviewer-regist':
                return $this->reviewerRegistService($request);

            case 'surgery-update':
                return $this->surgeryUpdateServices($request);
            case 'surgery-delete':
                return $this->surgeryDeleteServices($request);

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

            case 'surgery-final-judge':
                return $this->surgeryFinalJudgeServices($request);

            default:
                return notFoundRedirect();
        }
    }

    private function collectiveCreate(Request $request)
    {
        $this->transaction();

        try {
            $data = json_decode($request->data ?? [], true);

            foreach ($data as $idx => $item) {
                $user = User::where(['uid'=>trim($item['uid'])])->orderBy('sid','desc')->first();
                if(empty($user)) {
                    return $this->returnJsonData('alert', [
                        'case' => true,
                        'msg' => '회원정보를 찾을 수 없습니다.'.trim($item['uid']),
                        'location' => $this->ajaxActionLocation('reload' ),
                    ]);
                }


                $surgery = Surgery::where(['user_sid'=>$user->sid])->orderBy('sid','desc')->first();
                if(!empty($surgery)){
                    $surgery->regnum = $item['regnum'];
                    $surgery->mregnum = $item['mregnum'];
                    $surgery->certi = 'Y';
                    $surgery->update();
                }else{
//                    $item->merge([ 'user_sid' => $user->sid ]);
//                    $item = array_merge([ 'user_sid' => $user->sid ], $item);
//                    $surgery->setByData($item);

                    $surgery = new Surgery();
                    $surgery->user_sid = $user->sid;
                    $surgery->year = 2024;
                    $surgery->uid = $user->uid;
                    $surgery->regnum = $item['regnum'];
                    $surgery->mregnum = $item['mregnum'];
                    $surgery->renewal = strpos($item['mregnum'],'R') !== false ? 'Y':'N';
                    $surgery->save();
                }

            }

            $this->dbCommit('커스텀 중재시술인증 데이터 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function changeResultServices(Request $request)
    {
        $this->transaction();

        try {
            $surgery = Surgery::findOrFail($request->sid);
            $surgery->result = $request->target;
            $surgery->update();

            $this->dbCommit('중재시술 - 심사현황상태 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '심사상태가 변경 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function reviewerRegistService(Request $request)
    {
        $this->transaction();

        try {
            $surgery = Surgery::find($request->sid);
            $surgery->surgery_reviewer()->sync(json_decode($request->reviewer_sid, true));

            $this->dbCommit("중재시술 - 심사자 배정");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '심사자가 배정되었습니다.',
                'winClose' => $this->ajaxActionWinClose(false),
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

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '증례시술 인증 수정이 완료 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function surgeryDeleteServices(Request $request)
    {
        $this->transaction();

        try {
            $surgery = Surgery::findOrFail($request->sid);
            $surgery->del = 'Y';
            $surgery->deleted_at = date('Y-m-d H:i:s');
            $surgery->update();

            $this->dbCommit('중재시술인증 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '중재시술인증 삭제가 완료 되었습니다.',
                'location' => $this->ajaxActionLocation('reload' ),
            ]);

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
//                'location' => $this->ajaxActionLocation('replace', route('mypage.surgery') ),
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

    private function surgeryFinalJudgeServices(Request $request)
    {
        $this->transaction();
        try {
            $surgery = Surgery::findOrFail($request->sid);

            $surgery->setBydata($request);
            $surgery->update();

            $this->dbCommit('중재시술인증 최종 심사 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '중재시술인증 최종 심사가 완료되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }
}
