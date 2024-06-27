<?php

namespace App\Services\Admin\Status;

use App\Services\AppServices;
use Illuminate\Http\Request;
use App\Models\Referer;
use App\Models\Counter;
use Carbon\Carbon;

/**
 * Class StatServices
 * @package App\Services
 */
class StatusServices extends AppServices
{
    public function statService(Request $request)
    {
        $year = $request->year ?? now()->year;
        $month = $request->month ?? now()->format('m');
        $day = $request->day ?? (now()->format('Ym') === ($year . $month) ? now()->format('d') : '01');

        // 월별
        $monthData = [];
        for ($i = 1; $i <= 12; $i++) {
            $addMonth = addZero($i, 2);
            $whereMonth = $year . $addMonth;
            $monthData[$addMonth] = Counter::selectRaw("
                SUM(hit) AS hit,
                SUM(page) AS page
            ")
                ->where('d_regis', 'LIKE', "%{$whereMonth}%")
                ->first();
        }

        // 일별
        $dayData = [];
        $daysInMonth = Carbon::createFromDate($year, $month)->daysInMonth;
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $addDay = addZero($i, 2);
            $whereDay = $year . $month . $addDay;
            $dayData[$addDay] = Counter::selectRaw("
                SUM(hit) AS hit,
                SUM(page) AS page
            ")
                ->where('d_regis', 'LIKE', "%{$whereDay}%")
                ->first();
        }

        // 그래프 (시간별)
        $graphData = [];
        for ($i = 0; $i < 24; $i++) {
            $addTime = addZero($i, 2);
            $whereTime = $year . $month . $day . $addTime;
            $graphData[$addTime] = Referer::selectRaw("
                COUNT(sid) AS cnt
            ")
                ->where('d_regis', 'LIKE', "%{$whereTime}%")
                ->first();
        }

        $this->data['year'] = $year;
        $this->data['month'] = $month;
        $this->data['day'] = $day;

        $this->data['status'] = [
            'graph' => $graphData,
            'month' => $monthData,
            'day' => $dayData,
        ];

        return $this->data;
    }

    public function refererService(Request $request)
    {
        $year = $request->year ?? date('Y');
        $month = $request->month ?? date('m');
        $day = $request->day ?? '';

        $selectDate =  $year . $month . $day;

        $query = empty($day)
            ? Referer::whereRaw("DATE_FORMAT(d_regis, '%Y%m') LIKE '%{$selectDate}%'")
            : Referer::whereRaw("DATE_FORMAT(d_regis, '%Y%m%d') LIKE '%{$selectDate}%'");

        if ($request->search && $request->keyword) {
            $query->where($request->search, 'LIKE', "%{$request->keyword}%");
        }

        if ($request->sort) {
            $query->orderBy($request->sort, ($request->orderby ?? 'DESC'));
        }

        $lsit = $query->paginate($request->recnum ?? 10)->appends(request()->except(['page']));

        $this->data['list'] = setListSeq($lsit);
        $this->data['year'] = $year;
        $this->data['month'] = $month;
        $this->data['day'] = $day;

        return $this->data;
    }

    public function setCountService()
    {
        $ip = request()->ip();
        $cookie_ip = request()->cookie('mylogip');

        if (request()->server('HTTP_REFERER') && $cookie_ip == $ip) {
            $counter = Counter::where('d_regis', Carbon::today()->format('Ymd'))->first();
            $counter->page += 1;
            $counter->update();
        } else {
            if (!$cookie_ip) {
                $this->setReferer();
                $this->setCounter();
            }
        }

        $this->deleteReferer();

        setcookie('mylogip', $ip, 0, '/');
    }

    private function setCounter()
    {
        $counter = Counter::where('d_regis', Carbon::today()->format('Ymd'))->first();

        if (is_null($counter)) {
            $counter = new Counter();
            $counter->setByData();
            $counter->save();
        } else {
            $counter->hit += 1;
            $counter->page += 1;
            $counter->update();
        }
    }

    private function setReferer()
    {
        $referer = new Referer();
        $referer->setByData();
        $referer->save();
    }

    private function deleteReferer()
    {
        $referersavenum = 1000000; // 레퍼러 저장갯수

        $RFCOUNT = Referer::count();

        if ($RFCOUNT > $referersavenum) {
            $refererkillnum = ($RFCOUNT - $referersavenum);
            Referer::orderBy('sid')->limit($refererkillnum)->delete();
        }
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            default:
                return notFoundRedirect();
        }
    }
}
