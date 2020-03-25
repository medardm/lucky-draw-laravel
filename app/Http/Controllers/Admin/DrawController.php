<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DrawWinnerRequest;
use App\Models\Prize;
use App\Models\User\Winner;
use App\Models\User\Member;
use App\Models\PrizeUser;
use Illuminate\Http\Request;

class DrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Gate::authorize('view-admin-pages', auth()->user());
        $members = Member::has('tickets')->get();
        $winners = Winner::with('prize')->get()
            ->sortBy(function ($winner) {
                return $winner->prize->prize_id;
            });
        $aPrizes = Prize::available()->get();
        return view('pages.admin.draw.index', compact(['aPrizes', 'winners', 'members']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrawWinnerRequest $request)
    {
        $prize = Prize::find($request->prize_id);
        if ($request->generate_randomly == 'true') {
            $winner = $prize->findRandomWinner();

            return back()->with(
                'status',
                "{$prize->prize} winner: {$winner->name}, Ticket #: {$winner->prize->ticket->ticket_number}"
            );
        } else {
            dd($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function resetWinners()
    {
        PrizeUser::truncate();

        return back()->with('status', 'Winners were cleared');
    }
}
