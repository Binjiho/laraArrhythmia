<?php

namespace App\Services\Admin\Conference;

use App\Services\AppServices;
use App\Models\Conference;
use App\Models\Registration;
use App\Models\Abstracts;
use App\Models\Group;
use App\Models\User;
use App\Models\Affiliation;
use App\Services\Admin\Mail\MailServices;
use App\Services\Conference\ConferenceServices as WebConferenceServices;
use Illuminate\Http\Request;

/**
 * Class ConferenceServices
 * @package App\Services
 */
class ConferenceServices extends AppServices
{
    private $webConferenceServices;

    public function __construct()
    {
        $this->webConferenceServices = new WebConferenceServices();
    }

    public function indexService(Request $request)
    {
        $year = $request->year;
        $subject = $request->subject;

        $query = Conference::orderByDesc('sid');

        if (!empty($year) ) {
            $query->where('year', $year);
        }

        if (!empty($subject) ) {
            $query->where('subject', 'like', "%{$subject}%");
        }
        
        $list = $query->paginate(20);
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function modifyService(Request $request)
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

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'conference-update':
                return $this->conferenceUpdate($request);

            case 'conference-delete':
                return $this->conferenceDelete($request);

            default:
                return NotFoundRedirect();
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
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
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

            $this->dbCommit('관리자 학술행사 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }
}
