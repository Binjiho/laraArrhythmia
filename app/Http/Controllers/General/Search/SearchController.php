<?php

namespace App\Http\Controllers\General\Search;

use App\Http\Controllers\Controller;
use App\Services\General\Search\SearchServices;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $searchServices;
    public function __construct()
    {
        $this->searchServices = (new SearchServices());
        view()->share([
            'main_menu'=>'M3',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'searchConfig' => config('site.general.search'),
        ]);
    }

    public function index(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM3',
            'region'=>$request->region ?? '',
        ]);
        return view('general.search.index',$this->searchServices->listService($request));
    }

    public function data(Request $request)
    {
        return $this->searchServices->dataAction($request);
    }
}
