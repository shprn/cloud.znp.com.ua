<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Folder;

class FolderPolicy
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

    private function checkPathByPattern($pattern, $path) {

        $arrPattern = explode('/', strtolower($pattern));
        $arrPath = explode('/', strtolower($path));

        $arrPattern = array_slice($arrPattern, 0, count($arrPath));
        $pattern = implode("/", $arrPattern);

        $preg = str_replace( "[date]", "[\d|-]+", $pattern);
        $preg = str_replace( "/", "\/", $preg);
        $preg = "/" . $preg . "/";

        try {
            if (preg_match($preg, $path))
                return true;
        } catch (Exeption $e) {}

    }

    public function read(User $user, Folder $folder)
    {
        if ($user->admin)
            return true;

        $rights = $user->rights;
        foreach($rights as $right) {
            if ($this->checkPathByPattern($right->access_mask, $folder->pathWithDisk()))
                return true;
        }

        return false;
    }
}
