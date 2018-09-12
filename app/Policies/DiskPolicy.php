<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Disk;

class DiskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function read(User $user, Disk $disk)
    {

        if ($user->admin)
            return true;

        $rights = $user->rights;
        foreach($rights as $right) {
            $arrRight = explode('/', strtolower($right->access_mask));
            $diskRight = array_shift($arrRight);
            if ($diskRight == $disk->name)
                return true;
        }

        return false;
    }
}
