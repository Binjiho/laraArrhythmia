<?php

namespace App\Services\Admin\Member;

use App\Models\User;
use App\Models\Fee;
use App\Models\Affiliation;
use App\Services\CommonServices;
use App\Services\AppServices;
use Illuminate\Http\Request;
use App\Exports\Member\MemberExcel;
use Illuminate\Support\Facades\DB;

/**
 * Class MemberServices
 * @package App\Services
 */
class MemberServices extends AppServices
{
    private $userConfig;

    public function __construct()
    {
        $this->userConfig = config('site.user');
    }

    public function findUser(int $sid = 0)
    {
        return User::findOrFail($sid);
    }

    public function indexService(Request $request)
    {
        $query = User::orderByDesc('created_at');

        if ($request->withdrawal) { // 탈퇴회원 일떄
            $query->withTrashed()->whereNotNull('del_confirm');
        }else{
            $query->whereNull('del_confirm');
        }

        if ($request->level) { // 회원구분
            $query->where('level', $request->level);
        }

        if ($request->uid) { // 아이디
            $query->where('uid', 'like', "%{$request->uid}%");
        }

        if ($request->name_kr) { // 이름
            $query->where('name_kr', 'like', "%{$request->name_kr}%");
        }

        if ($request->email) { // 이메일
            $query->where('uid', 'like', "%{$request->email}%");
        }

        if ($request->phone) { // 휴대폰 번호
            $query->where('phone', 'like', "%{$request->phone}%");
        }

        if ($request->sosok) { // 근무처명
            $query->where('sosok', 'like', "%{$request->sosok}%");
        }

        // 엑셀 다운로드 일경우
        if ($request->excel) {
            $this->data['collection']= setSeq($query->get());
            $fileName = ($request->withdrawal) ? '탈퇴회원' : '회원';
            return (new CommonServices())->excelDownload(new MemberExcel($this->data), $fileName);
        }

        $user = $query->paginate(20)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($user);

        /**
         * 회비납부 여부
         */
        foreach ($this->data['list'] as $key => $user_item){

            $user_item->fee_status = 'A'; //미납
            foreach ($user_item->fee as $fee_item){
                if( $fee_item->year == date('Y') && $fee_item->pay_status == 'C') {
                    $user_item->fee_status = 'C'; //완납
                }
            }

        }

        /**
         * 통계
         */
        $userCnt = $query->select('level', DB::raw('count(*) as cnt'))->groupBy('level')->get(); // 회원구분
//        $categoryCnt = $query->select('category', DB::raw('count(*) as cnt'))->groupBy('category')->get(); // 근무처 구분
        $categoryCnt = DB::select(DB::raw("SELECT COUNT(*)AS cnt, category FROM user_binfo GROUP BY category")); //DB이전 하면서 10,11,12,13등 알 수없는 값이 들어옴

        $this->data['count'] = [];

        foreach ($userCnt as $row) {
            if(empty($this->data['count']['level']['total'])) {
                $this->data['count']['level']['total'] = 0;
            }

            $this->data['count']['level']['total'] += $row->cnt;
            $this->data['count']['level'][$row->level] = $row->cnt;
        }

        foreach ($categoryCnt as $row) {
            if(empty($this->data['count']['category']['total'])) {
                $this->data['count']['category']['total'] = 0;
            }

            $this->data['count']['category']['total'] += $row->cnt;
            $this->data['count']['category'][$row->category] = $row->cnt;
        }

        return $this->data;
    }

    public function modifyService(Request $request)
    {
        $this->data['user'] = User::findOrFail($request->sid);
        return $this->data;
    }
    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'member-login':
                return $this->memberLogin($request);
            case 'member-del':
                return $this->memberDel($request);
            case 'member-recovery':
                return $this->memberRecovery($request);    
            case 'member-update':
                return $this->memberUpdateServices($request);
            case 'level-change':
                return $this->levelChangeServices($request);
            case 'sosok-check':
                return $this->sosokCheckServices($request);
            default:
                return notFoundRedirect();
        }
    }

    private function memberLogin(Request $request)
    {
        $member = User::findOrFail($request->sid);
        auth('web')->login($member);

        $url = env('APP_URL') . '/main';
        return $this->returnJsonData('location', $this->ajaxActionLocation('replace', $url));
    }

    private function memberDel(Request $request)
    {
        $member = User::findOrFail($request->sid);

        if( $request->type == 'admin' ){
            $member->del_confirm = 'D';
        }
        $member->deleted_at = now();
        $member->save();

        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => '탈퇴처리가 완료 되었습니다.',
            'location' => $this->ajaxActionLocation('replace', route('member')),
        ]);
    }

    private function memberRecovery(Request $request)
    {
        $member = User::withTrashed()->findOrFail($request->sid);

        $member->del_confirm = null;
        $member->del_confirm_date = null;
        $member->deleted_at = null;
        $member->save();

        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => '복구가 완료 되었습니다.',
            'location' => $this->ajaxActionLocation('replace', route('member')),
        ]);
    }

    private function memberUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $user = $this->findUser($request->sid);

            // 회원사진 바로 삭제할수 있지만 DB update 실패시 사진 사라지면 안되서 변수로 임시 저장
            if ($request->file_del === 'Y') {
                $delete_file_path = $user->image_path;
            }

            $user->setBydata($request);
            $user->password_at = date('Y-m-d H:i:s');
            $user->update();

            $this->dbCommit('회원정보수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '회원정보가 수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }


    private function levelChangeServices(Request $request)
    {
        $this->transaction();

        try {
            $user = User::findOrFail($request->sid);

            $user->level = $request->target;

            $user->update();

            $this->dbCommit('회원등급 수정');

            //회원등급 변경시 회비 생성
            if($request->target == 'A' || $request->target == 'S'){
                try {
                    $fee = (new Fee());
                    $fee->user_sid = $user->sid;
                    $fee->year = date('Y');
                    $fee->category = $request->target;
                    $fee->detail = 'A';
                    $fee->pay_status = 'A';
                    $fee->price = config('site.fee')['price'][$request->target];
                    $fee->save();

                    $this->dbCommit("회비관리 - 회비등록");
                } catch (\Exception $e) {
                    return $this->dbRollback($e);
                }
            }

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '회원등급이 변경 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('member')),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function sosokCheckServices(Request $request)
    {
        $affi = Affiliation::where(['sid' => $request->affi_sid])->first();

        return $this->returnJsonData('input', [
            $this->ajaxActionInput('#sosok_kr', $affi->office_k ),
            $this->ajaxActionInput('#sosok_en', $affi->office_e ),
        ]);
    }

}
