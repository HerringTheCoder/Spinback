<?php
namespace App\Services;
use App\User;
use Auth;

class UserService
{

    public function destroy(User $user) : bool
    {
            if($user && $user->id!==Auth::Id()) {
                Transaction::Where('user_id', $user->id)->updated(array('user_id', NULL));
                $user->delete();
                return true;
            }
            else if($user->id===Auth::Id())
            {
                return false;
            }
    }

    public function deactivate(User $user) : bool
    {
        if($user && $user->id!==Auth::Id()) {

            Bouncer::Assign('deactivated')->to($user);
            return true;
        }
        else if($user->id===Auth::Id())
        {
            return false;
        }

    }



}
