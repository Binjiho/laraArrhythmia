<?php

namespace App\Http\Controllers\Eng\Journal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JournalController extends Controller
{

    public function __construct()
    {
        view()->share([
            'main_menu'=>'M2',
        ]);
    }

    public function index(Request $request)
    {
        view()->share('sub_menu', 'SM1');
        return view('eng.journal.index');
    }

    public function submission(Request $request)
    {
        view()->share('sub_menu', 'SM2');
        return view('eng.journal.submission');
    }

    public function instruction(Request $request)
    {
        view()->share('sub_menu', 'SM3');
        return view('eng.journal.instruction');
    }

}
