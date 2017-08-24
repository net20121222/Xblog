<?php

namespace App\Policies;

use App\Model\Page;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
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

    public function update(User $user, Page $page)
    {
        return isAdmin($user);
    }
}
