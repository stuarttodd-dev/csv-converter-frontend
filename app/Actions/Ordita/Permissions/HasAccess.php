<?php

namespace App\Actions\Ordita\Permissions;

use App\Models\User;

class HasAccess
{
    public function execute(User $user, array $permissions): bool
    {
        if ($user->super_user === 1) {
            return true;
        }

        $rights = $user->rights()->pluck('right_name')->toArray() ?? [];

        foreach ($permissions as $permission) {
            if (in_array($permission, $rights)) {
                return true;
            }
        }

        return false;
    }
}
