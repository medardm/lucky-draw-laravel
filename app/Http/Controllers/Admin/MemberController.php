<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddMemberRequest;
use App\Http\Requests\Admin\GenerateMemberRequest;
use App\Models\User\Member;
use App\Models\DrawTicket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MemberController extends Controller
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
    public function index(Member $members)
    {
        return view('pages.admin.member.index', [
            'members' => $members->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddMemberRequest $request)
    {
        if (!DrawTicket::areTicketsAvailable()) {
            return back()->with('error', "No more tickets is available");
        }
        $user = User::create($request->all());
        $user->tickets()->create([
            'ticket_number' => $request->ticket_number
        ]);

        return back()->with('status', "{$user->name} with ticket #{$user->tickets->first()->ticket_number} was added");
    }

    public function generate(GenerateMemberRequest $request)
    {
        if (!DrawTicket::areTicketsAvailable()) {
            return back()->with('error', "No more tickets is available");
        }
        $users = factory(User::class, (int) $request->number_of_users)->create();
        if ($request->generate_ticket == true) {
            $num = (int) $request->number_of_tickets;
            $users->each(function ($user) use ($num) {
                $user->tickets()->createMany(
                    factory(DrawTicket::class, $num)
                        ->make(['user_id' => $user->id])->toArray()
                );
            });
        }

        return back()->with('status', "{$users->count()} members were added");
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
}
