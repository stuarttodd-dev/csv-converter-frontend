<?php

namespace App\Actions\Ordita\RightGroups;

use App\Models\User;
use App\Models\UserRight;
use App\Models\UserRightGroup;

use Illuminate\Database\Eloquent\Collection;

class GetGroups
{
    public function execute(User $user): Collection
    {
        if ($user->super_user === 1) {
            return UserRightGroup::where('is_deleted', 0)
                ->orderBy('ordering')
                ->get();
        }

        $rightIds = $user->assignedRights()->pluck('right_id');
        $groupIds = UserRight::whereIn('id', $rightIds)
            ->pluck('right_group_id');

        return UserRightGroup::where('is_deleted', 0)
            ->whereIn('id', $groupIds)
            ->orderBy('ordering')
            ->get();
    }
}
