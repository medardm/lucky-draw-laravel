<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\Member;
use App\Models\User\Winner;
use App\Models\DrawTicket;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $members = Member::all();
        $winners = Winner::all();
        $tickets = DrawTicket::all();
        return view('home', compact([
            'members',
            'winners',
            'tickets'
        ]));
    }
}
