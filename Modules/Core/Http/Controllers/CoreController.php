<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function attendance()
    {
        return view('core::attendance.index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function academic()
    {
        return view('core::academic.index');
    }
}
