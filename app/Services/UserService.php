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

class UserService
{
    public function index()
    {
        $users = User::All();
        return $users;
    }
    public function create()
        {
        }
    public function show()
        {
        }
    public function update()
        {
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

}