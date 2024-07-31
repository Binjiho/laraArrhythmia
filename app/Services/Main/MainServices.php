<?php

namespace App\Services\Main;

use App\Models\Board;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class MainServices
 * @package App\Services
 */
class MainServices extends AppServices
{
    public function indexService(Request $request)
    {
        //공지사항 게시판
        $query = Board::where(['bbs_code'=>'notice', 'app_push'=>'Y', 'hide'=>'N', 'del' => 'N'])->withCount('files')->orderByDesc('sid');
        if(!isAdmin()){
//            $query->where('hide', '=', 'N');
        }
        $this->data['notice'] = $query->get();

        //동영상 강의 게시판
        $query = Board::where(['bbs_code'=>'video', 'app_push'=>'Y', 'hide'=>'N', 'del' => 'N'])->withCount('files')->orderByDesc('sid');
        if(!isAdmin()){
//            $query->where('hide', '=', 'N');
        }
        $this->data['video'] = $query->get();

        //팝업
        $now = date('Y-m-d');
        $query = Board::where(['bbs_code'=>'notice', 'popup'=>'Y', 'del' => 'N'])
            ->where([
                [DB::raw("DATE_FORMAT(popup_startdate, '%Y-%m-%d')"), '<=', $now],
                [DB::raw("DATE_FORMAT(popup_enddate, '%Y-%m-%d')"), '>=', $now]
            ])->orderByDesc('sid');
        if(!isAdmin()){
            $query->where('hide', '=', 'N');
        }
        $this->data['popupList'] = $query->get();

        return $this->data;
    }

    public function proService(Request $request)
    {
        //공지사항 게시판
        $query = Board::where(['bbs_code'=>'noticePro', 'app_push'=>'Y', 'hide'=>'N', 'del' => 'N'])->withCount('files')->orderByDesc('sid');
        if(!isAdmin()){
//            $query->where('hide', '=', 'N');
        }
        $this->data['notice'] = $query->get();

        //동영상 강의 게시판
        $query = Board::where(['bbs_code'=>'video', 'app_push'=>'Y', 'hide'=>'N', 'del' => 'N'])->withCount('files')->orderByDesc('sid');
        if(!isAdmin()){
//            $query->where('hide', '=', 'N');
        }
        $this->data['video'] = $query->get();

        //팝업
        $now = date('Y-m-d');
        $query = Board::where(['bbs_code'=>'noticePro', 'popup'=>'Y', 'del' => 'N'])
            ->where([
                [DB::raw("DATE_FORMAT(popup_startdate, '%Y-%m-%d')"), '<=', $now],
                [DB::raw("DATE_FORMAT(popup_enddate, '%Y-%m-%d')"), '>=', $now]
            ])->orderByDesc('sid');
        if(!isAdmin()){
            $query->where('hide', '=', 'N');
        }
        $this->data['popupList'] = $query->get();

        return $this->data;
    }

    public function generalService(Request $request)
    {
        //공지사항 게시판
        $query = Board::where(['bbs_code'=>'notice', 'app_push'=>'Y', 'hide'=>'N', 'del' => 'N'])->withCount('files')->orderByDesc('sid');
        if(!isAdmin()){
//            $query->where('hide', '=', 'N');
        }
        $this->data['notice'] = $query->get();

        //동영상 강의 게시판
        $query = Board::where(['bbs_code'=>'videoGeneral', 'app_push'=>'Y', 'hide'=>'N', 'del' => 'N'])->withCount('files')->orderByDesc('sid');
        if(!isAdmin()){
//            $query->where('hide', '=', 'N');
        }
        $this->data['video'] = $query->get();

        //팝업
        $now = date('Y-m-d');
        $query = Board::where(['bbs_code'=>'notice', 'popup'=>'Y', 'del' => 'N'])
            ->where([
                [DB::raw("DATE_FORMAT(popup_startdate, '%Y-%m-%d')"), '<=', $now],
                [DB::raw("DATE_FORMAT(popup_enddate, '%Y-%m-%d')"), '>=', $now]
            ])->orderByDesc('sid');

        if(!isAdmin()){
            $query->where('hide', '=', 'N');
        }
        $this->data['popupList'] = $query->get();

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'main-popup':
                return $this->mainPopupServices($request);

            default:
                return notFoundRedirect();
        }
    }

    private function mainPopupServices(Request $request)
    {
        $this->data['popup'] = [(object)$request->all()];
        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('body', view("common.popup.index", $this->data)->render())
        ]);
    }
}
