<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        //проверяем авторизацию для данного раздела
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('dashboard.pages.index');
    }

    public function dfsf()
    {
        // return response()->json([
        //     'user' => request()->user(),
        //     'msg' => 'Авторизован!'
        // ]);
    }
}
