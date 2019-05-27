<?php

namespace App\Http\Controllers;

use App\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Bouncer;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\StoreUser;

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
        $users = User::All();
        return view('users.index')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        User::Create($request->validated());
        return redirect()->route('users.index')->with('success', __('users.successfully_stored'));
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
    public function update(UpdateUser $request, User $user)
    {
        $user->update($request->validated());
        return redirect()->route('users.index')->with('success', __('users.successfully_updated'));
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
        if( $this->user->safeDelete($user) )
        return redirect()->route('users.index')->with('success', __('users.successfully_deleted'));
        else
        return redirect()->route('users.index')->with('warning', __('users.self_protection'));
    }

    public function deactivate(User $user)
    {
        if($this->user->safeDeactivate($user))
        return redirect()->route('users.index')->with('success', __('users.successfully_deactivated'));
        else
        return redirect()->route('users.index')->with('warning', __('users.self_protection'));
    }
}
