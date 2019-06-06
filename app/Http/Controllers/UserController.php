<?php

namespace App\Http\Controllers;

use App\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Bouncer;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\Auth;
use App\Department;
use App\Http\Requests\ChangePassword;
use Illuminate\Support\Facades\Hash;
use App\Mail\AccountDetails;
use Illuminate\Support\Facades\Mail;

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

    public function show(User $user)
    {
        return view('users.profile')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        if ($request->has('send_email')) {
            Mail::to($user)->send(new AccountDetails($user->login, $request->input('password')));
        }
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
        return view('users.edit')->with('user', $user);
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
        if ($this->user->safeDelete($user))
            return redirect()->route('users.index')->with('success', __('users.successfully_deleted'));
        else
            return redirect()->route('users.index')->with('warning', __('users.self_protection'));
    }

    public function deactivate(User $user)
    {
        if ($this->user->safeDeactivate($user))
            return redirect()->route('users.index')->with('success', __('users.successfully_deactivated'));
        else
            return redirect()->route('users.index')->with('warning', __('users.self_protection'));
    }

    public function settings()
    {
        $user = Auth::user();
        // $departments = Department::all();
        return view('users.settings', compact('user', 'departments'));
    }

    public function changePassword(ChangePassword $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->route('users.settings')->with('error', 'Wrong current password');
        }
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
        return redirect()->route('users.settings')->with('success', 'Password succesfully changed');
    }
}
