<?php

namespace App\Http\Controllers;

use App\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Bouncer;

class UserController extends Controller
{
    public function __construct(UserService $user)
    {
        $this->user = $user;
        $this->authorizeResource(User::class);
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     * @param $successMsg
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=$this->user->index();
       $message = session('message');
        return view('test.users.panel')->with('users', $users)->with('message', $message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->user->validateStore($request);
        $this->user->store($request);
        return redirect()->action('UserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('test.users.profile')->with('user', $user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //return view('users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->user->validateUpdate($request);
        $this->user->update($user, $request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function destroy(User $user)
    {
        $this->user->destroy($user);
        return redirect()->action('UserController@index');
    }
}
