<?php

namespace App\Actions\Ordita\Administrators;

use App\Models\User;
use App\Models\UserRight;

use Illuminate\Database\Eloquent\Collection;

class GetAdministrators
{
    public function execute(): Collection
    {
        $administrators = User::with('assignedRights', 'assignedRights.right')
            ->where('is_deleted', false)
            ->get();

        $allRights = UserRight::where('is_deleted', false)
            ->pluck('id')
            ->toArray();

        foreach ($administrators as &$administrator) {

            if ($administrator->super_user) {
                $administrator->rightIds = $allRights;
                continue;
            }

            $administrator->rightIds = $administrator->assignedRights
                ->map(function ($assignedRight) {
                    return $assignedRight->right->id;
                })
                ->filter()
                ->toArray();
        }

        return $administrators;
    }
}
