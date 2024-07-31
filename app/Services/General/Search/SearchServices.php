<?php

namespace App\Services\General\Search;

use App\Models\User;
use App\Models\Surgery;

use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class BoardServices
 * @package App\Services
 */
class SearchServices extends AppServices
{
    public function listService(Request $request)
    {
        $this->searchConfig = config('site.general.search');
        $region = $request->region ?? null;
        $category = $request->category ?? null;
        $keyword = $request->keyword ?? null;

        $query = User::orderByDesc('sid');
//        $query = User::whereNotIn('del_confirm', ['D','R','Y'])->orderByDesc('sid');

        if (!empty($region) ) {
            $query->whereRaw("SUBSTRING_INDEX(office_addr1,' ', 1) REGEXP '{$this->searchConfig['region'][$region]}' ");
//            $query->where('office_addr1','like', "%{$this->searchConfig['region'][$region]}%");
        }

        $query->where('level','!=','M');
        $query->where('name_kr','!=','');
        $query->where('search_yn','!=','N');

        if (!empty($category) ) {
            if($category == 'A' /*전문회원*/){
                $query->where('level', '=', 'S');
            }else if ($category == 'B' /*부정맥 중재시술인증의*/){
                $sid_arr = DB::select(DB::raw("select user_sid from surgery where del='N' AND certi='Y' "));
                $tmp_arr = array();
                foreach ($sid_arr as $key => $row) {
                    $tmp_arr[] = $row->user_sid;
                }
                $query->whereIn('sid', $tmp_arr );
            }
        }else{
            $sid_arr = DB::select(DB::raw("select user_sid from surgery where del='N' AND certi='Y' "));
            $tmp_arr = array();
            foreach ($sid_arr as $key => $row) {
                $tmp_arr[] = $row->user_sid;
            }
//            $query->Where('level', '=', 'S')
//                ->orWhereIn('sid', $tmp_arr);

            $placeholders = implode(',', array_fill(0, count($tmp_arr), '?'));

            $query->whereRaw("( level = 's' OR sid IN ( ".$placeholders." ) )", $tmp_arr);
        }

        if (!empty($keyword) ) {
            $query->where('name_kr','like', "%{$keyword}%");
            $query->orWhere('first_name','like', "%{$keyword}%");
            $query->orWhere('last_name','like', "%{$keyword}%");
        }



        $cnt = clone $query;
        $list = $query->paginate(10)->appends($request->query());

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            default:
                return notFoundRedirect();
        }
    }

}
