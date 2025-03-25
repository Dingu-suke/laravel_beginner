<?php

namespace App\Http\Controllers;

class TopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('top.index');
    }

    public function runteq()
    {
        $robot = (['name' => 'ロボらんてくん']);
        return view('top.runteq', compact('robot'));
    }
}
