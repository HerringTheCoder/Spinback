<?php
namespace App\Services;

use App\User;
use Auth;
use App\Transaction;

class UserService
{

    public function safeDelete(User $user): bool
    {
        if ($user && $user->id !== Auth::Id()) {
            Transaction::Where('user_id', $user->id)->update(['user_id' => NULL]);
            $user->delete();
            return true;
        } else if ($user->id === Auth::Id()) {
            return false;
        }
    }

    public function safeDeactivate(User $user): bool
    {
        if ($user && $user->id !== Auth::Id()) {

            Bouncer::Assign('deactivated')->to($user);
            return true;
        } else if ($user->id === Auth::Id()) {
            return false;
        }
    }
}
