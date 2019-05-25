<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 02.05.2019
 * Time: 19:04
 */

namespace App\Services;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserService
{
    public function index()
    {
        $users = User::All();
        return $users;
    }

    public function store(Request $request) : void
        {
            $user=new User;
            $user->login = $request->input('login');
            $user->password = Hash::make($request->input('password'));
            $user->first_name=$request->input('first_name');
            $user->last_name= $request->input('last_name');
            $user->email=$request->input('email');
            $user->save();
            session()->flash('message', 'Account created successfully');
            return;

        }
    public function update(User $user, Request $request) : void
        {
            $user->first_name= $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email=$request->input('email');
            $user->save();
            return;
        }

    public function destroy(User $user) :void
    {
            if($user && $user->id!==Auth::Id()) {
                $user->delete();
                session()->flash('message','User deleted successfully');
            }
            else if($user->id===Auth::Id())
            {
                session()->flash('message','You can'.'t delete your own account');
            }
            else{
                session()->flash('message','User not found');
            }
            return;
    }

    public function validateStore(Request $request) :void
    {
        $request->validate([
            'login'=>'required|alpha|max:30',
            'first_name' => 'min:3|max:20',
            'last_name' => 'min:3|max:20',
            'email' => 'unique|required|min:10|max:50'
        ]);
        return;
    }
    
    public function validateUpdate(Request $request)
    {
        $request->validate([

            'first_name' => 'required|min:3|alpha|max:20',
            'last_name' => 'required|min:3|alpha|max:20',
            'email' => 'unique|min:10|max:50'
        ]);
    }

}
